<?php

use phpmock\session\MockBuilder;
use PHPUnit\Framework\TestCase;

require_once 'control/Controllers.php';
require_once 'service/UserChecking.php';
require_once 'service/YearChecking.php';
require_once 'service/GameChecking.php';
require_once 'service/OutputData.php';
require_once 'data/UserSqlAccess.php';
require_once 'data/YearSqlAccess.php';
require_once 'service/UserAccessInterface.php';


class ControllersTest extends TestCase
{
    private $outputData;
    private $controllers;

    protected function setUp(): void
    {
        $this->outputData = $this->createMock(OutputData::class);
        $this->controllers = new Controllers($this->outputData);
    }

    public function testAuthenticateActionIncorrectUsernameOrPassword()
    {
        $userChecking = $this->createMock(UserChecking::class);
        $data = $this->createMock(UserAccessInterface::class);
        $sessionData = [];

        // Test case: no login session data
        $postData = [
            'login' => 'testuser',
            'password' => 'testpassword',
            'g-recaptcha-response' => 'testcaptcharesponse'
        ];

        // Case 1: Incorrect username or password
        $userChecking->expects($this->once())
            ->method('authenticate')
            ->with($postData['login'], $postData['password'], $data);

        $this->outputData->expects($this->once())
            ->method('getOutputData')
            ->willReturn(false);

        $result = $this->controllers->authenticateAction($userChecking, $data, $postData, $sessionData);
        $this->assertEquals('Mauvais identifiant ou mot de passe !', $result);
    }

    public function testAuthenticateActionCaptchaVerificationFails()
    {
        $userChecking = $this->createMock(UserChecking::class);
        $data = $this->createMock(UserAccessInterface::class);
        $sessionData = [];

        // Test case: no login session data
        $postData = [
            'login' => 'testuser',
            'password' => 'testpassword',
            'g-recaptcha-response' => 'testcaptcharesponse'
        ];

        // Case 2: Correct username and password, but captcha verification fails
        $userChecking->expects($this->once())
            ->method('authenticate')
            ->with($postData['login'], $postData['password'], $data);

        $this->outputData->expects($this->exactly(2))
            ->method('getOutputData')
            ->willReturnOnConsecutiveCalls(true, false);

        $userChecking->expects($this->once())
            ->method('verifyCaptcha')
            ->with($postData['g-recaptcha-response'], $data);

        $result = $this->controllers->authenticateAction($userChecking, $data, $postData, $sessionData);
        $this->assertEquals('Vous etes un robot !', $result);
    }

    public function testAuthenticateActionSuccessfulAuthenticationAndCaptchaVerification()
    {
        $userChecking = $this->createMock(UserChecking::class);
        $data = $this->createMock(UserAccessInterface::class);
        $sessionData = [];

        // Test case: no login session data
        $postData = [
            'login' => 'testuser',
            'password' => 'testpassword',
            'g-recaptcha-response' => 'testcaptcharesponse'
        ];

        // Case 3: Successful authentication and captcha verification
        $userChecking->expects($this->once())
            ->method('authenticate')
            ->with($postData['login'], $postData['password'], $data);

        $this->outputData->expects($this->exactly(2))
            ->method('getOutputData')
            ->willReturn(true);

        $userChecking->expects($this->once())
            ->method('verifyCaptcha')
            ->with($postData['g-recaptcha-response'], $data);

        $result = $this->controllers->authenticateAction($userChecking, $data, $postData, $sessionData);
        $this->assertNull($result);
        $this->assertTrue($sessionData['isLogged']);
    }

    public function testModificationActionModifyOption()
    {
        $data = $this->createMock(YearSqlAccess::class);
        $yearChecking = $this->createMock(YearChecking::class);
        $postData = [
            'text' => 'New Option Text',
            'idText' => 1,
            'idOpt' => 1
        ];

        $data->expects($this->once())
            ->method('modifyOpt')
            ->with($postData['idOpt'], $postData['idText'], $postData['text']);

        $controller = new Controllers(new OutputData());
        $controller->modificationAction($yearChecking, $data, $postData);
    }

    public function testModificationActionModifyTextSup()
    {
        $data = $this->createMock(YearSqlAccess::class);
        $yearChecking = $this->createMock(YearChecking::class);
        $postData = [
            'text' => 'New Text Sup',
            'idTextSup' => 1
        ];

        $data->expects($this->once())
            ->method('modifyTextSup')
            ->with($postData['idTextSup'], $postData['text']);

        $controller = new Controllers(new OutputData());
        $controller->modificationAction($yearChecking, $data, $postData);
    }

    public function testModificationActionModifyChoice()
    {
        $yearChecking = $this->createMock(YearChecking::class);
        $data = $this->createMock(YearSqlAccess::class);

        $postData = [
            'text' => 'New choice text',
            'idText' => 1
        ];

        $data->expects($this->once())
            ->method('modifyChoice')
            ->with($postData['idText'], $postData['text']);

        $this->controllers->modificationAction($yearChecking, $data, $postData);
    }

    public function testModificationActionGetYearsData()
    {
        $yearChecking = $this->createMock(YearChecking::class);
        $data = $this->createMock(UserAccessInterface::class);

        $postData = [];

        $yearChecking->expects($this->once())
            ->method('getYearsData')
            ->with($data);

        $this->controllers->modificationAction($yearChecking, $data, $postData);
    }
    public function testGameAction()
    {
        $gameChecking = $this->createMock(GameChecking::class);
        $data = $this->createMock(UserAccessInterface::class);

        $gameChecking->expects($this->once())
            ->method('getYearsData')
            ->with($data);

        $this->controllers->gameAction($gameChecking, $data);
    }

}