<?php

class TestView {

    // Pfad zum Template
    private $path = 'templates';
    // Name des Templates, in dem Fall das Standardtemplate.
    private $template = 'login';

    //Enthält die Variablen, die in das Template eingebetet
    private $entries = array();

    public function assignEntries($entries) {
        $this->entries = $entries;
    }

    public function setPath($newPath) {
        $this->path = $newPath;
    }

    /**
     * Setzt den Namen des Templates.
     * @param String $template Name des Templates.
     */
    public function setTemplate($template = 'login') {
        $this->template = $template;
    }

    /**
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }


    /**
     * Das Template-File laden und zurückgeben
     * @param string $tpl Der Name des Template-Files (falls es nicht vorher über setTemplate() zugewiesen wurde).
     * @return string Der Output des Templates.
     */
    public function loadTemplate() {
        $tpl = $this->template;
        // Pfad zum Template erstellen & überprüfen ob das Template existiert.
        $file = $this->path . DIRECTORY_SEPARATOR . $tpl . '.php';

        if (file_exists($file)) {
            // Der Output des Scripts wird in einem Buffer gespeichert, d.h.
            // nicht gleich ausgegeben.
            ob_start();

            // Das Template-File wird eingebunden und dessen Ausgabe in
            // $output gespeichert.
            include $file;
            $output = ob_get_contents();
            ob_end_clean();

            // Output zurückgeben.
            return $output;
        } else {
            // Template-File existiert nicht-> Fehlermeldung.
            return 'could not find template';
        }
    }
}

?>