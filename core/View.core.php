<?php
class View {
    protected $_head, $_body, $_foot, $_siteTitle, $_outputBuffer, $_layout, $_pageName, $_payload;

    public function __construct($layout) {
        if($this->_pageName === null) {
            $this->_pageName = Config::get("app.name");
            $this->_layout = $layout;
        }
    }

    public function render($viewName, $view, $payload = '', $useLayout = true) {
        if(file_exists(VIE . $viewName. DS . $view. '.view.php')) {
            $this->_payload = $payload;
            require_once VIE . $viewName. DS . $view. '.view.php';

            if($useLayout) {
                if(file_exists(LAY . $this->_layout . '.layout.php')) {
                    require_once LAY . $this->_layout . '.layout.php';
                } else {
                    die("Thew Layout {$this->_layout} does not exist");
                }
            }
        } else {
            die("Thew View {$viewName} with the view of {$view} does not exist");
        }
    }

    public function content($type) {
        switch($type) {
            case 'head':
                return $this->_head;
            case 'body':
                return $this->_body;
            case 'foot':
                return $this->_foot;
            default:
            return false;
                break;
        }
    }


    public function start($type) {
        ob_start();
        $this->_outputBuffer = $type;
    }

    public function end() {
        switch($this->_outputBuffer) {
            case 'head':
                $this->_head = ob_get_clean();
                break;
            case 'body':
                $this->_body = ob_get_clean();
                break;
            case 'foot':
                $this->_foot = ob_get_clean();
                break;
            default:
                return false;
                break;
        }
    }

    public function siteTitle() {
        return $this->_siteTitle;
    }

    public function setSiteTitle($title) {
        $this->_siteTitle = $title;
    }


    public function pageName() {
        return $this->_pageName;
    }

    public function setPageName($name) {
        $this->_pageName = $name;
    }

    public function getPayload() {
        return $this->_payload;
    }
}