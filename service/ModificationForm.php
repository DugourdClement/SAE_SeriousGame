<?php

class ModificationForm
{
    protected $outputData;
    protected $modificationTxt;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function authenticate( $username, $password, $data )
    {
        $user = $data->isUser( $username, $password );
        return ( $user != null );
    }

    public function getAllForm( $data )
    {
        $this->modificationTxt = array();

        for ($i = 1; $i < 8; $i++){
            $this->modificationTxt[] = $data->getYearData($i);
        }

        $this->outputData->setOutputData($this->modificationTxt);
    }
}