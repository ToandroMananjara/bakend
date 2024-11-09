<?php
class View
{
    private $template;
    public function __construct($template)
    {
        $this->template = $template;
    }

    public function render($datas)
    {
        $template = $this->template;
        include_once(VIEW . $template . '.php');
    }
}
