<?php

class Controller {

    public $request = null;
    private $action = '';
    public static $registerInfo = false;
    public static $registerError = [];

    /**
     * Im Konstruktor wird der request den Attributen $request und $action übergeben
     * @param Array $request Array aus $_GET & $_POST.
     */
    public function __construct($request) {
        $this->request = $request;

        // wenn keine Action im Request ausgewählt ist, wird das Template "erfassen" als
        // Standard genommen (z.B. beim ersten Aufruf der Seite)
        $this->action = !empty($request['action']) ? $request['action'] : 'login';
    }

    /**
     * Methode zur Auswahl des Templates und Rückgabe der Inhalte
     * @return String Inhalt des Templates
     */
    public function display() {
        global $entityManager;

        $view = new View();
        $model = new Model($entityManager);

        if (isset($this->request['username']) && isset($this->request['password']) && $this->action != 'register') {
            $logininfo = $model->login($this->request['username'], $this->request['password']);
            if ($logininfo) {
                $view->setTemplate('contest-overview');
                return $view->loadTemplate();
            } else {
                $view->setTemplate('login-failed');
                return $view->loadTemplate();
            }
        }

        if (!$model->isLoggedIn() && $this->action != 'login' && $this->action != 'register') {
            $view->setTemplate('login');
            return $view->loadTemplate();
        }

        switch ($this->action) {

            case 'login':
                if ($model->isLoggedIn()) {
                    $view->setTemplate('contest-overview');
                } else {
                    $view->setTemplate('login');
                }

                break;

            case 'register':
                if ($model->isLoggedIn()) {
                    $view->setTemplate('contest-overview');
                } else {
                    if (sizeof($this->request) > 1) {
                        self::$registerInfo = $model->register($this->request['username'], $this->request['email'], $this->request['password'], $this->request['password-repeat']);
                    }
                    $view->setTemplate('register');
                }
                break;

            case 'contest-overview':
                $view->setTemplate('contest-overview');
                break;

            case 'contest-new':
                if (Model::isAdmin() || Model::isManager()) {
                    if (sizeof($this->request) > 1) {
                        $model->addContest($this->request["name"], $this->request["description"], $this->request["image_url"], $this->request["starts_at"], $this->request["ends_at"]);
                        $view->setTemplate('contest-overview');
                    } else {
                        $view->setTemplate('contest-new');
                    }
                } else {
                    $view->setTemplate('contest-overview');
                }
                break;

            case 'contest-details':
                if (isset($this->request["id"])) {
                    $view->setTemplate('contest-details');
                } else {
                    $view->setTemplate('contest-overview');
                }

                break;

            case 'contest-edit':
                 if (sizeof($this->request) > 2 && (Model::isAdmin() || Model::isManager())) {
                   $model->updateContest($this->request["id"], $this->request["name"], $this->request["description"], $this->request["image_url"], $this->request["starts_at"], $this->request["ends_at"]);
                   $view->setTemplate('contest-overview');
                   }
                   else if (isset($this->request["id"]) && (Model::isAdmin() || Model::isManager())) {
                        $view->setTemplate('contest-edit');
                   }
                   else {
                   $view->setTemplate('contest-overview');
                   }

                   break;

            case 'idea-details':
                if (isset($this->request["id"])) {
                    $view->setTemplate('idea-details');
                } else {
                    $view->setTemplate('contest-details');
                }

                if(isset($this->request["add-comment"])) {
                    Model::addComment($this->request["text"], $this->request["id"]);
                }

                break;

            case 'idea-edit':
                if (sizeof($this->request) > 2) {
                    $model->updateIdea($this->request["id"], $this->request["name"], $this->request["description"], $this->request["image_url"]);
                    $view->setTemplate('idea-details');
                }
                else if (isset($this->request["id"])) {
                    $view->setTemplate('idea-edit');
                }
                else {
                    $view->setTemplate('idea-details');
                }
                break;

            case 'idea-new':
                if (sizeof($this->request) > 2) {
                    $model->addIdea($this->request["name"], $this->request["description"], $this->request["image_url"],$this->request["id"]);
                    $view->setTemplate('contest-details');
                }

                else if (isset($this->request["id"])) {
                    $view->setTemplate('idea-new');
                }
                else {
                    $view->setTemplate('contest-details');
                }
                break;

            case 'logout':
                session_destroy();
                $view->setTemplate('login');
                break;

            case 'search':
                if (isset($this->request["search"])) {
                    $view->setTemplate('search');
                }
                else {
                   $view->setTemplate('contest-overview');
                }

                break;

        }
        return $view->loadTemplate();
    }
}

?>