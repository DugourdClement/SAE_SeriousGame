<?php

use PHPUnit\Framework\TestCase;

require_once 'UserChecking.php';

class UserCheckingTest extends TestCase
{
    private $userChecking;
    private $outputData;
    private $data;

    protected function setUp(): void
    {
        $this->outputData = $this->createMock(OutputData::class);
        $this->data = $this->createMock(Data::class);
        $this->userChecking = new UserChecking($this->outputData);
    }

    public function testAuthenticate()
    {
        $login = 'john_doe';
        $password = 'password123';
        $user = ['name' => 'John Doe', 'email' => 'john@example.com'];

        $this->data->expects($this->once())
            ->method('isUser')
            ->with($this->equalTo($login), $this->equalTo($password))
            ->willReturn($user);

        $this->outputData->expects($this->once())
            ->method('setOutputData')
            ->with($this->equalTo($user));

        $this->userChecking->authenticate($login, $password, $this->data);
    }

    public function testVerifyCaptcha()
    {
        $captchaResponse = 'some_captcha_response';
        $captchaSuccess = true;

        $this->data->expects($this->once())
            ->method('verifyCaptcha')
            ->with($this->equalTo($captchaResponse), $this->equalTo($this->data))
            ->willReturn($captchaSuccess);

        $this->outputData->expects($this->once())
            ->method('setOutputData')
            ->with($this->equalTo($captchaSuccess));

        $this->userChecking->verifyCaptcha($captchaResponse, $this->data);
    }
}
