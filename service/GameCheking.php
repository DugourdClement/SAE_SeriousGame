<?php

class GameCheking
{
    protected $outputFile;

    public function __construct($outputFile)
    {
        $this->outputFile = $outputFile;
    }

    public function getYearsData($data)
    {
        $yearDataTxt = array();

        for ($i = 1; $i < 8; $i++) {
            $yearDataTxt[] = $data->getYearData($i);
        }

        // enregistrement des annonces dans un fichier sur le serveur (serialisation)
        $yearDataSerialized = serialize($yearDataTxt);
        file_put_contents('/data/' . $this->outputFile, $yearDataSerialized);
    }
}