<?php

use PHPUnit\Framework\TestCase;

require_once 'Controllers.php';

class ControllersTest extends TestCase
{
    private $controllers;
    private $outputData;
    private $userChecking;
    private $data;
    private $yearChecking;
    private $gameChecking;

    protected function setUp(): void
    {
        $this->outputData = $this->createMock(OutputData::class);
        $this->userChecking = $this->createMock(UserChecking::class);
        $this->data = $this->createMock(Data::class);
        $this->yearChecking = $this->createMock(YearChecking::class);
        $this->gameChecking = $this->createMock(GameChecking::class);
        $this->controllers = new Controllers($this->outputData);
    }

    public function testAuthenticateAction()
    {
        // Test cases for successful authentication
        $_POST['login'] = 'testuser';
        $_POST['password'] = 'testpassword';
        $_POST['g-recaptcha-response'] = 'valid_recaptcha';

        $this->userChecking->expects($this->once())
            ->method('authenticate')
            ->with('testuser', 'testpassword', $this->data)
            ->willReturn(true);

        $this->outputData->expects($this->at(0))
            ->method('getOutputData')
            ->willReturn(true);

        $this->userChecking->expects($this->once())
            ->method('verifyCaptcha')
            ->with('valid_recaptcha', $this->data)
            ->willReturn(true);

        $this->outputData->expects($this->at(1))
            ->method('getOutputData')
            ->willReturn(true);

        $result = $this->controllers->authenticateAction($this->userChecking, $this->data);
        $this->assertNull($result);
    }

    public function testModificationAction()
    {
        // Case 1: Test when 'text' and 'idText' are set, and 'idOpt' is set
        $_POST['text'] = 'Some text';
        $_POST['idText'] = 1;
        $_POST['idOpt'] = 2;

        $this->data->expects($this->once())
            ->method('modifyOpt')
            ->with(2, 1, 'Some text');

        $this->controllers->modificationAction($this->yearChecking, $this->data);

        // Resetting $_POST for the next test case
        $_POST = array();

        // Case 2: Test when 'text' and 'idText' are set, and 'idTextSup' is set
        $_POST['text'] = 'Some text';
        $_POST['idText'] = 1;
        $_POST['idTextSup'] = 3;

        $this->data->expects($this->once())
            ->method('modifyTextSup')
            ->with(3, 'Some text');

        $this->controllers->modificationAction($this->yearChecking, $this->data);

        // Resetting $_POST for the next test case
        $_POST = array();

        // Case 3: Test when 'text' and 'idText' are set, and neither 'idOpt' nor 'idTextSup' is set
        $_POST['text'] = 'Some text';
        $_POST['idText'] = 1;

        $this->data->expects($this->once())
            ->method('modifyChoice')
            ->with(1, 'Some text');

        $this->controllers->modificationAction($this->yearChecking, $this->data);

        // Resetting $_POST for the next test case
        $_POST = array();

        // Case 4: Test when 'text' and 'idText' are not set
        $this->yearChecking->expects($this->once())
            ->method('getYearsData')
            ->with($this->data);

        $this->controllers->modificationAction($this->yearChecking, $this->data);    }

    public function testGameAction()
    {
        // Test when gameAction is called
        $this->gameChecking->expects($this->once())
            ->method('getYearsData')
            ->with($this->data);

        $this->controllers->gameAction($this->gameChecking, $this->data);    }
}
