<?php
class Button extends Component {
    public function __construct($content, $attributes=[], $render = false) {
        parent::__construct('button',  $attributes, $content,);

        if($render) {
            echo $this->render();
        } else {
            $this->render();
        }
    }
}