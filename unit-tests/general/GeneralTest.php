<?php

include "./Triangle.php";

class GeneralTest extends PHPUnit_Framework_TestCase {

    public static $paramCount = 0;

    public function testTriangleEqualsDreieck() {

        $triangle = new Triangle(1, 2, 5);
        $dreieck = new Triangle(1, 2, 5);

        $this->assertContainsOnlyInstancesOf('Triangle', array($triangle, $dreieck));

    }

    public function testXIsInRange() {

        $randInt = rand(-30, 78);

        $this->assertGreaterThanOrEqual(-30, $randInt);
        $this->assertLessThanOrEqual(78, $randInt);

    }

    public function testTooManyParameters() {

        $expectedParamCount = 3;

        $args = array(1, 2, 3, 4);

       $this->assertTrue(sizeOf($args) == $expectedParamCount, "Anzahl der Parameter zu groß");

    }

    public function testValueEquals() {
        $anzahlSpalten = 20;
        $anzahlZeilen = 20;
        $this->assertSame($anzahlSpalten, $anzahlZeilen);
    }

    public function testDifferenceIsLower() {
        $messErgebnis = 5;
        $referenz = 4.91;

        $diff = $messErgebnis - $referenz;

        $this->assertLessThanOrEqual(0.1, $diff);
    }

}