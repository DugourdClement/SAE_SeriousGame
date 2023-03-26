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

    public function modifyChoice($data, $idText, $text)
    {
        $data->modifyChoice($idText, $text);
    }

    public function modifyOpt($data, $idOpt, $idText, $text)
    {
        $data->modifyOpt($idOpt, $idText, $text);
    }

    public function modifyTextSup($data, $idTextSup, $text)
    {
        $data->modifyTextSup($idTextSup, $text);
    }
}