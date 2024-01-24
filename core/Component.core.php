<?php
class Component {
    protected $_tag;

    protected $_attributes = [];

    protected $_content = '';

    protected $children = [];


    public function __construct($tag, $attributes=[], $content='') {
        $this->_tag = $tag;
        $this->_content = $content;
        $this->_attributes = $attributes;
    }

    public function setAttribute($key, $value) {
        $this->_attributes[$key] = $value;
    }

    public function removeAttribute($key) {
        unset($this->_attributes[$key]);
    }

    public function append($child) {
        $this->children[] = $child;
    }

    public function render() {
        $att = '';

        if(isset($this->_attributes) ) {
            foreach($this->_attributes as $key => $value) {
                $att .= " {$key}='{$value}'";
            }
        }

        $content = $this->_content;

        if(isset($this->children)) {
            foreach($this->children as $child) {
                $content .= $child->render();
            }
        }

        return "<{$this->_tag}{$att}>{$content}</{$this->_tag}>";
    }
}