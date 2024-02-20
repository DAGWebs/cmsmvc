<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {
    private $_mail;

    /**
     * Constructor initializes PHPMailer with configuration settings from the Config class.
     * It sets up the mailer to use SMTP with authentication and encryption as specified in the configuration.
     */

    public function __construct() {
        $this->_mail = new PHPMailer(Config::get('email.debug'));
        $this->_mail->isSMTP();
        $this->_mail->Host = Config::get('email.host');
        $this->_mail->SMTPAuth = true;
        $this->_mail->Username = Config::get('email.user');
        $this->_mail->Password = Config::get('email.password');
        $this->_mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->_mail->Port = 465;
    }
    /**
     * Sends an email to a specified recipient with optional CC, BCC, and attachments.
     * Allows for both HTML and plain text content to be set for the email body.
     *
     * @param string|array $to Recipient's email address or an array of addresses.
     * @param string $subject Subject of the email.
     * @param string $message HTML or plain text message body.
     * @param array $cc Array of CC'd email addresses.
     * @param array $bcc Array of BCC'd email addresses.
     * @param array $att Array of attachments.
     * @param bool $useHTML Whether to send the email as HTML. Defaults to true.
     * @return bool Returns true on success, or false on failure.
     */
    public function send($to, $subject, $message, $cc = [], $bcc = [], $att = [], $useHTML = true) {
        $from = Config::get('email.from');
        $reply = Config::get('email.reply');
        try {
            $this->setFromField($from);
            $this->setToField($to);
            $this->setReplyField($reply);
            $this->setFields($cc);
            $this->setFields($bcc, true);
            $this->setAttField($att);

            $this->_mail->isHTML($useHTML);

            $this->_mail->Subject = $subject;
            $this->_mail->Body = $message;
            $this->_mail->AltBody = strip_tags($message);

            $this->_mail->send();
        } catch (Exception $e) {
            if(Config::get('email.debug')) {
                echo $e->getMessage();
                die();
            } else {
                return false;
            }
        }
    }

    /**
     * Sets the "From" field of the email. Can handle both string and associative array inputs.
     *
     * @param string|array $from The sender's email address and optionally the name.
     */

    private function setFromField($from) {
        if(is_array($from)){
            if(array_key_exists('address', $from) && array_key_exists('name', $from)){
                $this->_mail->setFrom($from['address'], $from['name']);
            } else if(array_key_exists('name', $from) && !array_key_exists('address', $from)){
                $this->_mail->setFrom($from['name']);
            } else if(!array_key_exists('name', $from) && array_key_exists('address', $from)){
                $this->_mail->setFrom($from['name']);
            } else if(Helper::isAssoc($from)){
                foreach($from as $key => $value){
                    $this->_mail->setFrom($key, $value);
                }
            } else {
                foreach($from as $email){
                    $this->_mail->setFrom($email);
                }
            }
        } else {
            $this->_mail->setFrom($from);
        }
    }

    /**
     * Adds one or more recipient addresses to the email. Handles both string and array inputs.
     *
     * @param string|array $to Recipient email address(es).
     */

    private function setToField($from) {
        if(is_array($from)){
            if(array_key_exists('address', $from) && array_key_exists('name', $from)){
                $this->_mail->addAddress($from['address'], $from['name']);
            } else if(array_key_exists('name', $from) && !array_key_exists('address', $from)){
                $this->_mail->addAddress($from['name']);
            } else if(!array_key_exists('name', $from) && array_key_exists('address', $from)){
                $this->_mail->addAddress($from['name']);
            } else if(Helper::isAssoc($from)){
                foreach($from as $key => $value){
                    $this->_mail->addAddress($key, $value);
                }
            } else {
                foreach($from as $email){
                    $this->_mail->addAddress($email);
                }
            }
        } else {
            $this->_mail->addAddress($from);
        }
    }

    /**
     * Sets the "Reply-To" address of the email. Supports both string and associative array inputs.
     *
     * @param string|array $from Reply-To email address and optionally the name.
     */

    private function setReplyField($from) {
        if(is_array($from)){
            if(array_key_exists('address', $from) && array_key_exists('name', $from)){
                $this->_mail->addReplyTo($from['address'], $from['name']);
            } else if(array_key_exists('name', $from) && !array_key_exists('address', $from)){
                $this->_mail->addReplyTo($from['name']);
            } else if(!array_key_exists('name', $from) && array_key_exists('address', $from)){
                $this->_mail->addReplyTo($from['name']);
            } else if(Helper::isAssoc($from)){
                foreach($from as $key => $value){
                    $this->_mail->addReplyTo($key, $value);
                }
            } else {
                foreach($from as $email){
                    $this->_mail->addReplyTo($email);
                }
            }
        } else {
            $this->_mail->addReplyTo($from);
        }
    }

    /**
     * Adds attachments to the email. Supports handling both file paths and names through array inputs.
     *
     * @param array $att Array of attachments where key can be the file path and value the name.
     */

    private function setAttField($from) {
        if(is_array($from)){
            if(array_key_exists('address', $from) && array_key_exists('name', $from)){
                $this->_mail->addAttachment($from['address'], $from['name']);
            } else if(array_key_exists('name', $from) && !array_key_exists('address', $from)){
                $this->_mail->addAttachment($from['name']);
            } else if(!array_key_exists('name', $from) && array_key_exists('address', $from)){
                $this->_mail->addAttachment($from['name']);
            } else if(Helper::isAssoc($from)){
                foreach($from as $key => $value){
                    $this->_mail->addAttachment($key, $value);
                }
            } else {
                foreach($from as $email){
                    $this->_mail->addAttachment($email);
                }
            }
        } else {
            $this->_mail->addAttachment($from);
        }
    }

    /**
     * General method for adding CC or BCC addresses to the email. Supports both string and array inputs.
     *
     * @param array|string $to Email address(es) to add.
     * @param bool $cc If true, adds as CC. If false, adds as BCC. Defaults to false.
     */

    private function setFields($to, $cc = false) {
        if($cc) {
            if(is_array($to)) {
                foreach($to as $email) {
                    $this->_mail->addCC($email);
                }
            } else {
                $this->_mail->addCC($to);
            }
        } else {
            if(is_array($to)) {
                foreach($to as $email) {
                    $this->_mail->addBCC($email);
                }
            } else {
                $this->_mail->addBCC($to);
            }
        }
    }
}