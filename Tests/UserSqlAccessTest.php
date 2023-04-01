<?php
use PHPUnit\Framework\TestCase;

require 'data/UserSqlAccess.php';

class UserSqlAccessTest extends TestCase
{
protected $dataAccess;

protected function setUp(): void
{
$this->dataAccess = $this->createMock(UserSqlAccess::class);
}

    public function testIsUser()
    {
        // Create instance of UserSqlAccess
        $userSqlAccess = new UserSqlAccess($this->dataAccess);

        // Set expectations for PDO mock object
        $this->dataAccess->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("SELECT mdp FROM utilisateur WHERE identifiant = :username"))
            ->willReturn($this->createMock(PDOStatement::class));
        $statementMock = $this->createMock(PDOStatement::class);
        $statementMock->expects($this->once())
            ->method('execute')
            ->with($this->equalTo(array(':username' => 'testuser')))
            ->willReturn(true);
        $statementMock->expects($this->once())
            ->method('fetch')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->willReturn(array('mdp' => password_hash('testpassword', PASSWORD_DEFAULT)));
        $this->dataAccess->expects($this->once())
            ->method('lastInsertId')
            ->willReturn('1');

        // Call method being tested
        $result = $userSqlAccess->isUser('testuser', 'testpassword');

        // Assert that the result matches the expected value
        $this->assertTrue($result);
    }
public function testVerifyCaptcha()
{
// Create instance of UserSqlAccess
$userSqlAccess = new UserSqlAccess($this->dataAccess);

// Call method being tested
$result = $userSqlAccess->verifyCaptcha('testresponse');

// Assert that the result matches the expected value
$this->assertFalse($result);
}
}
