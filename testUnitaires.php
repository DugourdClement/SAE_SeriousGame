<?php

use PHPUnit\Framework\TestCase;
class LogoutTest extends PHPUnit_Framework_TestCase
{
    public function testSessionIsUnsetAndDestroyed()
    {
        // arrange
        $_SESSION['user'] = 'test_user';
        $this->assertTrue(isset($_SESSION['user']));

        // act
        include 'logout.php';

        // assert
        $this->assertFalse(isset($_SESSION['user']));
    }

    public function testHeaderLocation()
    {
        // arrange
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['REQUEST_URI'] = '/';

        // act
        ob_start();
        include 'logout.php';
        $header = ob_get_clean();

        // assert
        $this->assertEquals('Location: http://localhost/ViewLogin.php', $header);
    }
}

