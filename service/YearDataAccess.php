<?php

class YearDataAccess
{
    protected $outputData;
    protected $yearDataTxt;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function authenticate( $username, $password, $response, $data )
    {
        if( $data->isUser($username, $password) != null && $data->verifyCaptcha($response)) {
            return true;
        }
        return false; // ici on rentre la
    }
}