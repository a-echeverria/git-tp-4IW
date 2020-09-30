<?php

namespace Pa\Core;

class View
{
    private $template;
    private $view;
    private $data = [];

    /**
     * View constructor.
     * @param $view
     * @param string $template
     * Initialise la vue et le template
     */
    public function __construct($view, $template="back")
    {
        $this->setTemplate($template);
        $this->setView($view);
    }

    /**
     * @param $t
     * Recupère et verifie que le template indiqué existe
     */
    public function setTemplate($t)
    {
        $this->template = trim($t);

        if (!file_exists("Views/templates/".$this->template.".php")) {
            die("Le template n'existe pas");
        }
    }

    /**
     * @param $v
     * Recupère et verifie que la vue indiqué existe
     */
    public function setView($v)
    {
        $this->view = trim($v);

        if (!file_exists("Views/".$this->view.".php")) {
            die("La vue n'existe pas");
        }
    }

    /**
     * @param $modal
     * @param $data
     * @param null $editData
     * Verifie et affiche une modal
     */
    public function addModal($modal, $data, $editData = null)
    {
        if (!file_exists("Views/modals/".$modal.".php")) {
            die("Le modal n'existe pas!!!");
        }

        include "Views/modals/".$modal.".php";
    }

