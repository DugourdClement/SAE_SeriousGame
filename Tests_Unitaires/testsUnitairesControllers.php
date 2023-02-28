<?php
use PHPUnit\Framework\TestCase;

class testsUnitairesControllers extends TestCase
{
    public function testModificationAction()
    {
        $login = 'testuser';
        $password = 'testpassword';
        $data = array('champ1' => 'valeur1', 'champ2' => 'valeur2');
        $modificationForm = new ModificationForm();

        $test = new Controllers();

        $modificationFormMock = $this->getMockBuilder(ModificationForm::class)
            ->setMethods(array('authenticate', 'getAllForm'))
            ->getMock();
        $modificationFormMock->expects($this->once())
            ->method('authenticate')
            ->with($this->equalTo($login), $this->equalTo($password), $this->equalTo($data))
            ->willReturn(true);

        $modificationFormMock->expects($this->once())
            ->method('getAllForm')
            ->with($this->equalTo($data));

        $example->modificationAction($login, $password, $data, $modificationFormMock);
        
        $this->assertEquals($_SESSION['username'], $login);
        $this->assertEquals($_SESSION['isLogin'], true);
    }
}
