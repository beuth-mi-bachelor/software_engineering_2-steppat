<?php

include './../entities/User.php';

include 'testClasses/test_view.php';
include 'testClasses/test_model.php';


class ModelTest extends \PHPUnit_Framework_TestCase {

    // check if default template is selected
    public function testGetContest() {
        $view = new TestView();
        $view->setPath("./../templates/");
        $erg = $view->loadTemplate();
        $this->assertNotEquals('could not find template', $erg);
    }

    public function testSetDefaultTemplate() {
        $view = new TestView();

        $shouldBe = $view->getTemplate();

        $view->setTemplate("test");
        $this->assertEquals("test", $view->getTemplate());

        $view->setTemplate();
        $this->assertEquals($shouldBe, $view->getTemplate());
    }


    public function testLogin() {

        $model = new TestModel();

        $username = "test";
        $email = "test@test.de";
        $password = "test";

        $user = TestModel::register($username, $email, $password, $password);

        $erg = TestModel::login($user, $username, $password);

        $this->assertTrue($erg);

        $this->assertTrue(TestModel::isLoggedIn());

    }


    public function testRegister() {
        $model = new TestModel();

        $username = "test";
        $email = "test@test.de";
        $password = "test";

        $erg = TestModel::register($username, $email, $password, $password);

        $this->assertNotFalse($erg);
        $this->assertInstanceOf("User", $erg);
        $this->assertNotEquals($password, $erg->getPassword());

    }

    public function testRegisterProof() {
        $model = new TestModel();

        $cUsername = "dana";
        $wUsername = "";

        $cEmail = "test@test.de";
        $wEmail = "";

        $cPassword = "test";
        $w1Password = "";
        $w2Password = "test";

        $cPassword2 = "test";
        $w1Password2 = "";
        $w2Password2 = "test2";

        // user empty
        $erg = TestModel::register($wUsername, $cEmail, $cPassword, $cPassword2);
        $this->assertNotInstanceOf("User", $erg);

        // email empty
        $erg = TestModel::register($cUsername, $wEmail, $cPassword, $cPassword2);
        $this->assertNotInstanceOf("User", $erg);

        // both pw emtpy
        $erg = TestModel::register($cUsername, $cEmail, $w1Password, $w1Password2);
        $this->assertNotInstanceOf("User", $erg);

        // pw not equal
        $erg = TestModel::register($cUsername, $cEmail, $w2Password, $w2Password2);
        $this->assertNotInstanceOf("User", $erg);

    }


}