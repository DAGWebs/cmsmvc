<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {
    private $_mail;

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