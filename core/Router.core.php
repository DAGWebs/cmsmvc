<?php
class Router {
    protected $_routes = [], $_payload = [];

    public function get($path, $callback, $payload = []) {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode("/", $url);

            if(isset($url) && $url[0] === '') {
                array_shift($url);
            } 

            if(!empty($url)) {
                array_shift($url);
            }

            if(!empty($url) && $url[0] !== '') {
                $url = "/" . $url[0];
            } else {
                $url = '/';
            }

            if($url === $path) {
                $this->_routes["GET"][$path] = $callback();
            } 
        }
    }

    public function post($path, $callback, $payload = []) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode("/", $url);

            if(isset($url) && $url[0] === '') {
                array_shift($url);
            } 

            if(!empty($url)) {
                array_shift($url);
            }

            if(!empty($url) && $url[0] !== '') {
                $url = "/" . $url[0];
            } else {
                $url = '/';
            }

            if($url === $path) {
                $this->_routes["POST"][$path] = $callback();
            } 
        }
    }

    public function put($path, $callback, $payload = []) {
        if($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode("/", $url);

            if(isset($url) && $url[0] === '') {
                array_shift($url);
            } 

            if(!empty($url)) {
                array_shift($url);
            }

            if(!empty($url) && $url[0] !== '') {
                $url = "/" . $url[0];
            } else {
                $url = '/';
            }

            if($url === $path) {
                $this->_routes["PUT"][$path] = $callback();
            } 
        }
    }

    public function delete($path, $callback, $payload = []) {
        if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode("/", $url);

            if(isset($url) && $url[0] === '') {
                array_shift($url);
            } 

            if(!empty($url)) {
                array_shift($url);
            }

            if(!empty($url) && $url[0] !== '') {
                $url = "/" . $url[0];
            } else {
                $url = '/';
            }

            if($url === $path) {
                $this->_routes["DELETE"][$path] = $callback();
            } 
        }
    }

    public function getPayload() {
        return $this->_payload;
    }

    public function route() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = explode("/", $_SERVER['REQUEST_URI']);
        $domain = Config::get('domain');

        $x = count($domain);

        if($x == 3) {
            $sub = $domain[0];
        } else {
            $sub = '';
        }

       isset($requestUri) && $requestUri[0] == '' ? array_shift($requestUri) : "";
       if(!empty($requestUri) && $sub === 'api') {
            $this->handleApiEndpoints($requestUri);
       } else {
            $this->handleAutoRouting($requestUri);
       }
       
    }
    protected function handleApiEndpoints($requestMethod) {
        $urlReal = $_SERVER['REQUEST_URI'];
        $urlReal = explode("/", $urlReal);
        $url = $requestMethod;

        if(isset($urlReal) && empty($urlReal[0]) || $urlReal[0] === '') {
            array_shift($urlReal);
            if(isset($urlReal) && $urlReal[0] === '') {
                $this->getController('HomeApi', 'index');
            }
        }
        
        if(file_exists(API . Config::get('api.version') . DS . 'endpoints' . DS  . $url[0] . '.php')) {
            $uri = $url;
            
            array_shift($uri);

            if(!empty($uri)) {
                $this->_payload = [];
                array_push($this->_payload, $uri);
            }
            
            
        
           

            require_once API . Config::get('api.version') . DS . 'endpoints' . DS  . $url[0] . '.php';
            
        } else {
            $this->handleNotFound();
        }
    }

    protected function handleAutoRouting($segments) {
    
        isset($segments[0]) && empty($segments[0]) ? array_shift($segments) : "";
        $controller = isset($segments[0]) && !empty($segments[0]) ? ucfirst($segments[0]) : ucfirst(Config::get('default-controller'));
        $action = isset($segments[1]) && !empty($segments[1]) ? $segments[1] . 'Action' : Config::get('default_action') . 'Action';

        if(!empty($segments)) {
            array_shift($segments);
        }

        if(!empty($segments)) {
            array_shift($segments);
        }

        $this->getController($controller, $action, $segments);
    }

    protected function getController($controller, $action, $useArgs = false) {
        if(file_exists(CON . $controller. DS . $controller . '.controller.php')) {
            if(class_exists($controller) && method_exists(new $controller($controller, $action), $action)) {
                $controllerInstance = new $controller($controller, $action);

                if($useArgs && is_array($useArgs)) {
                    $this->invokeCallbackWithArguments([$controllerInstance, $action], $useArgs);
                } else {
                    $this->invokeCallback([$controllerInstance, $action]);
                }
                
            }
        }
    }

    protected function handleNotFound() {
        $this->getController('PageNotFound', 'indexAction');

        http_response_code(404);
        echo '404 Page Not Found';
        die();
    }

    protected function invokeCallbackWithArguments($callback, $args) {
        if(is_callable($callback)) {
            call_user_func_array($callback, $args);
        } else {
            $this->handleNotFound();
        }
    }


    protected function invokeCallback($callback) {
        if(is_callable($callback)) {
            call_user_func($callback); 
        } else {
            $this->handleNotFound();
        }
    }


    public function push($path) {
        return header("Location: https://{$path}");
    }

    public function redirect($location) {
        return header("Location: /{$location}");
    }
}