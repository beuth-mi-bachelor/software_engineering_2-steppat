<?php
class Controller{

	private $request = null;
	private $action = '';

	/**
	 * Im Konstruktor wird der request den Attributen $request und $action übergeben
	 * @param Array $request Array aus $_GET & $_POST.
	 */
	public function __construct($request){
		$this->request = $request;

		// wenn keine Action im Request ausgewählt ist, wird das Template "erfassen" als
		// Standard genommen (z.B. beim ersten Aufruf der Seite)
		$this->action = !empty($request['action']) ? $request['action'] : 'login';
	}

	/**
	 * Methode zur Auswahl des Templates und Rückgabe der Inhalte
	 * @return String Inhalt des Templates
	 */
	public function display(){
		$view = new View();
		switch($this->action){

// TODO: Implement all cases where template-files are created

			case 'login':
                //Model::login($this->request['username'], $this->request['password']);
				$view->setTemplate('login');
				break;

            case 'Speichern':
                Model::appendEntry($this->request['nr'], $this->request['name'], $this->request['preis'] );
                //Model::appendEntry("1234","Maschine","90,00" );
                $view->setTemplate('erfassen');
                break;

			case 'Liste':
				$view->setTemplate('liste');
                $entries = Model::getEntries();
                //var_dump($entries);
                $view->assignEntries($entries);
				break;

		}
		return $view->loadTemplate();
	}
}
?>