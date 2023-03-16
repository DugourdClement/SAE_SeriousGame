<?php

class UserChecking
{
    protected $user;

    protected $captcha;

    protected $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function authenticate($login, $password, $data)
    {
        $this->user = $data->isUser($login, $password);
        $this->outputData->setOutputData($this->user);
    }

    public function verifyCaptcha($reponse, $data)
    {
        $this->captcha = $data->verifyCaptcha($reponse, $data);
        $this->outputData->setOutputData($this->captcha);
    }
}