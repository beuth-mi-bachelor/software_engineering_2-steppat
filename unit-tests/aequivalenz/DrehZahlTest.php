<?php
/**
 * Created by PhpStorm.
 * User: angi
 * Date: 28.01.15
 * Time: 11:54
 */
include 'drehZahlMesser.php';


class TestDrehZahl extends PHPUnit_Framework_TestCase {


    public function test1() {

        $drehZahl = new drehZahlMesser();
        $drehZahl->setDrehZahl(1400);
        $this->assertFalse($drehZahl->getDrehZahl() === null, "Wert ist größer als 1400");
    }

    public function test2() {

        $drehZahl = new drehZahlMesser();
        $drehZahl->setDrehZahl(0);
        $this->assertFalse($drehZahl->getDrehZahl() === null, "Wert ist kleiner als 0");
    }

    public function test3() {

        $drehZahl = new drehZahlMesser();
        $drehZahl->setDrehZahl(5999);
        $this->assertStringStartsWith('Warnung', $drehZahl->getEcho());
    }

}
 