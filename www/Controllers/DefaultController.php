<?php
use TP\Core\View;

class DefaultController
{
    public function defaultAction()
    {
        $view = new View("home");
    }
}