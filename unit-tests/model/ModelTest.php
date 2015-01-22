<?php
require_once './../vendor/autoload.php';
include './../classes/model.php';
require_once "./../entities/User.php";
require_once "./../entities/Contest.php";


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
// TODO: all
class ModelTest extends \PHPUnit_Framework_TestCase {


    public function testGetContest()
    {
        // First, mock the object to be used in the test
        $contest = $this->getMock('Contest');

        // Now, mock the repository so it returns the mock of the employee
        $contestRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $contestRepository->expects($this->once())
            ->method('find')
            ->will($this->returnValue($contest));

        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($contestRepository));

        $model = new Model($entityManager);
        $this->assertNotEquals(null, $model->getContest(2));
    }

    public function test() {
        $this->assertEquals(true, true);
    }

}