<?php

class GameChecking
{
    protected $outputFile;

    public function __construct($outputFile)
    {
        $this->outputFile = $outputFile;
    }

    public function getYearsData($data)
    {
        $yearDataObject = array();

        for ($i = 1; $i < 8; $i++) {
            $yearDataObject[] = $data->getYearData($i);
        }

        // enregistrement des annonces dans un fichier sur le serveur (serialisation)
        $yearDataSerialized = json_encode($yearDataObject);
        file_put_contents('/home/serious/www/sae/data/' . $this->outputFile . '.json', $yearDataSerialized);
    }
}