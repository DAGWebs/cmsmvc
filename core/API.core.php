<?php
class API
{
    protected $_code = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    ];

    protected $_payload = [];

    /**
     * Constructor function that sets the response content type to JSON and extracts the URL
     * components after the '/api' segment.
     *
     * @throws None
     * @return None
     */
    public function __construct()
    {
        header('Content-Type: application/json');
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);

        if (isset($url) && $url[0] === '') {
            array_shift($url);
            array_shift($url);
            array_shift($url);
        } else {
            array_shift($url);
            array_shift($url);
        }

        $router = new Router();
        $this->_payload = $url;

        foreach ($url as $part) {
            if ($part === '' || $part === 'api') {
                array_shift($url);
            }
        }
    }

    /**
     * Decodes a JSON string and returns the corresponding PHP value.
     *
     * @param string $json A JSON encoded string to decode
     * @return mixed The value encoded in json in appropriate PHP type.
     */
    public function decode($json)
    {
        echo json_decode($json);
    }

    /**
     * Encodes a PHP array or object into a JSON string.
     *
     * @param mixed $data The PHP array or object to be encoded.
     * @return string|null Returns a JSON encoded string on success or null on failure.
     */
    public function encode($data)
    {
        return json_encode($data);
    }

    /**
     * Sends a response back to the client.
     *
     * @param mixed $type the type of response to send
     * @param mixed $message the message to send with the response
     * @param mixed $data any data to send with the response
     * @throws ErrorException if the status code is not found
     */
    public function response($type, $message, $data)
    {
        if (array_key_exists($type, $this->_code)) {
            $code = $this->_code[$type];
            http_response_code($code);

            $response = array(
                'status' => array($code, $type),
                'message' => array($message),
                'data' => array($data)
            );

            echo $this->encode($response);
            exit;
        } else {
            throw new ErrorException('Status code not found, please check the status code.');
        }
    }

    /**
     * Sends a success response with message and data.
     *
     * @param mixed $message The message to include in the response.
     * @param mixed $data The data to include in the response.
     * @throws N/A
     * @return void
     */
    public function successResponse($message, $data)
    {
        $statusCode = 200;
        http_response_code($statusCode);

        $response = array(
            'status' => array($statusCode, 'success'),
            'message' => array($message),
            'data' => array($data)
        );

        echo $this->encode($response);
        exit;
    }


    /**
     * Generates a bad request error response with a given message.
     *
     * @param string $message the error message to display
     * @throws None
     * @return None
     */
    public function badRequestResponse($message)
    {
        $statusCode = 400;
        http_response_code($statusCode);

        $response = array(
            'status' => array($statusCode, 'bad_request'),
            'message' => array($message),
            'data' => array()
        );

        echo $this->encode($response);
        exit;
    }

    /**
     * Generate an unauthorized response with a given message.
     *
     * @param string $message The message to include in the response.
     * @throws No exceptions thrown.
     * @return void
     */
    public function unauthorizedResponse($message)
    {
        $statusCode = 401;
        http_response_code($statusCode);

        $response = array(
            'status' => array($statusCode, 'unauthorized'),
            'message' => array($message),
            'data' => array()
        );

        echo $this->encode($response);
        exit;
    }

    /**
     * Executes a GET request to the specified URL and handles the response based on the given response type.
     *
     * @param mixed $url The URL to send the request to.
     * @param callable $callback A function to call before the request is sent.
     * @param string $response The type of response to handle. Possible values: 'success', 'bad_request', 'unauthorized'.
     * @param array $headers An array of HTTP headers to include in the request.
     * @throws Exception If there is an error with the request.
     * @return mixed The response from the server if the request is successful.
     */
    public function get($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
    {
        $data = call_user_func($callback, $this->_payload);


        if (is_array($data) && array_key_exists('url', $data)) {
            if ($this->open($data['url'], 'GET', $data['data'], $headers)) {
                return $this->open($data['url'], 'GET', $data['data'], $headers);
            } else {
                $this->badRequestResponse('There was an error with the request');
            }
        }

        switch ($response) {
            case 'success':
                $r = $this->successResponse('OK: ' . $url, $data, $headers);
                break;
            case 'bad_request':
                $r = $this->badRequestResponse('Bad request: ' . $url);
                break;
            case 'unauthorized':
                $r = $this->unauthorizedResponse('Unauthorized: No token provided');
                break;
        }
    }

    /**
     * Executes a POST request to a given URL using a callback function.
     *
     * @param mixed $url the URL to send the request to
     * @param callable $callback the callback function to execute
     * @param string $response the response type (default: 'success')
     * @param array $headers the request headers (default: ["Content-Type: application/json"])
     * @throws Exception if there is an error with the request
     * @return mixed the result of the request
     */
    public function post($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
    {
        $data = call_user_func($callback);


        if (is_array($data)) {
            if ($this->open($data['url'], 'POST', $data['data'], $headers)) {
                return $this->open($data['url'], 'POST', $data['data'], $headers);
            } else {
                $this->badRequestResponse('There was an error with the request');
            }
        }

        switch ($response) {
            case 'success':
                $this->successResponse('OK: ' . $url, $data, $headers);
                break;
            case 'bad_request':
                $this->badRequestResponse('Bad request: ' . $url);
                break;
            case 'unauthorized':
                $this->unauthorizedResponse('Unauthorized: No token provided');
                break;
        }
    }

    /**
     * Updates a resource from a given URL and returns a success or error response.
     *
     * @param mixed $url The URL to update the resource.
     * @param callable $callback A callback function to be called before the switch statement.
     * @param string $response The desired response type. Default: 'success'
     * @param array $headers An optional array of headers to send with the request. Default: ["Content-Type: application/json"]
     * @throws Exception If there is an error with the request.
     * @return mixed Returns the result of the open() function if it is successful, otherwise returns a bad request response.
     */
    public function update($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
    {
        $data = call_user_func($callback);


        if (is_array($data)) {
            if ($this->open($data['url'], 'UPDATE', $data['data'], $headers)) {
                return $this->open($data['url'], 'UPDATE', $data['data'], $headers);
            } else {
                $this->badRequestResponse('There was an error with the request');
            }
        }

        switch ($response) {
            case 'success':
                $this->successResponse('OK: ' . $url, $data, $headers);
                break;
            case 'bad_request':
                $this->badRequestResponse('Bad request: ' . $url);
                break;
            case 'unauthorized':
                $this->unauthorizedResponse('Unauthorized: No token provided');
                break;
        }
    }

    /**
     * Deletes a resource from the specified URL.
     *
     * @param string $url The URL of the resource to delete.
     * @param callable $callback The callback function to call.
     * @param string $response The response type to use. Default is 'success'.
     * @param array $headers The headers to use. Default is ["Content-Type: application/json"].
     * @throws Exception If there was an error with the request.
     * @return mixed The result of the request, or an error if there was one.
     */
    public function delete($url, $callback, $response = 'success', $headers = ["Content-Type: application/json"])
    {
        $data = call_user_func($callback);


        if (is_array($data)) {
            if ($this->open($data['url'], 'DELETE', $data['data'], $headers)) {
                return $this->open($data['url'], 'DELETE', $data['data'], $headers);
            } else {
                $this->badRequestResponse('There was an error with the request');
            }
        }

        switch ($response) {
            case 'success':
                $this->successResponse('OK: ' . $url, $data, $headers);
                break;
            case 'bad_request':
                $this->badRequestResponse('Bad request: ' . $url);
                break;
            case 'unauthorized':
                $this->unauthorizedResponse('Unauthorized: No token provided');
                break;
        }
    }

    /**
     * Sends an HTTP request using the cURL library.
     *
     * @param string $url The URL to which the request is sent.
     * @param string $type The HTTP method used for the request.
     * @param mixed $data The data to be sent with the request.
     * @param array $headers Optional headers to be sent with the request.
     * @throws ErrorException Throws an exception if the request encounters an error.
     * @return mixed The response returned by the server.
     */
    private function open($url, $type, $data, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        if ($type === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
        }

        if (!is_array($headers)) {
            throw new ErrorException('The open function in the API class requires the Headers to be an array.');
        }

        if (is_array($data)) {
            $data = json_encode($data);
        } else if (!$this->decode($data)) {
            throw new ErrorException('The open function in the API class requires the data to be a valid JSON string or an array.');
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        switch ($type) {
            case 'GET':
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            default:
                throw new ErrorException('The open function in the API class requires the type to be either GET, POST, PUT or DELETE.');
                break;
        }

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new ErrorException($error);
        }

        curl_close($ch);

        return $response;
    }
}
