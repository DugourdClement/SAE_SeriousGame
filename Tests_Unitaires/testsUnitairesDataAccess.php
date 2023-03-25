<?php
use PHPUnit\Framework\TestCase;

class testUnitairesDataAccess extends TestCase
{
    public function testIsUser()
    {
        $username = 'testuser';
        $password = 'testpassword';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $test = new DataAccess();

        $dataAccessMock = $this->getMockBuilder(DataAccess::class)
            ->setMethods(array('prepare', 'execute', 'fetch'))
            ->getMock();
        $prepareQueryMock = $this->getMockBuilder(PDOStatement::class)
            ->setMethods(array('execute', 'fetch'))
            ->getMock();
        $prepareQueryMock->expects($this->once())
            ->method('execute')
            ->with($this->equalTo(array(':username' => $username)));
        $prepareQueryMock->expects($this->once())
            ->method('fetch')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->willReturn(array('mdp' => $hashedPassword));
        $dataAccessMock->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("SELECT mdp FROM utilisateur WHERE identifiant = :username"))
            ->willReturn($prepareQueryMock);

        $reflection = new ReflectionClass($test);
        $property = $reflection->getProperty('dataAccess');
        $property->setAccessible(true);
        $property->setValue($test, $dataAccessMock);

        $result = $test->isUser($username, $password);
        
        $this->assertTrue($result);

        $result = $test->isUser($username, 'wrongpassword');
        
        $this->assertFalse($result);
    }
}
