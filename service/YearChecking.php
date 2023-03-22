<?php

class YearChecking
{
    protected $outputData;

    protected $yearDataTxt;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function getYearsData( $data )
    {
        $this->yearDataTxt = array();

        for ($i = 1; $i < 8; $i++){
            $this->yearDataTxt[] = $data->getYearData($i);
        }

        $this->outputData->setOutputData($this->yearDataTxt);
    }
}