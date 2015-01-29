<?php


class DrehZahlMesser {

    private $drehZahl = null;
    private $echo = null;

    public function setDrehZahl($wert)
    {
        if ($wert >= 0 && $wert <= 1400) {
            $this->drehZahl = $wert;
        }
        else if ($wert > 5000 && $wert < 6000) {
            $this->drehZahl = $wert;
            $this->echo = "Warnung: Drehzahl ist zu hoch!";
        }
        else {
            $this->echo = "Benzineinspritzung unterbrochen";
        }
    }

    public function getDrehZahl()
    {
        return $this->drehZahl;
    }

    public function getEcho()
    {
        return $this->echo;
    }

}

?>