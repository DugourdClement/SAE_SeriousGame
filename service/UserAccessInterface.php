<?php

interface UserAccessInterface
{
    public function isUser($login, $password);

    function verifyCaptcha($response);
}