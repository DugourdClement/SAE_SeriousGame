<?php
include_once 'domain/YearData.php';
include_once 'domain/Choice.php';
include_once 'service/YearAccessInterface.php';

class YearSqlAccess implements YearAccessInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function __destruct()
    {
        $this->dataAccess = null;
    }

    function getYearData($year)
    {
        // query for the associated textSup
        try {
            $query = "SELECT COUNT(DISTINCT id_texte) as nbTextSup, GROUP_CONCAT(texte SEPARATOR ', ') as textSup FROM texte WHERE id_texte REGEXP :regexSup";
            $prepareQuery = $this->dataAccess->prepare($query);
            $regexSup = "^{$year}\d$";
            $prepareQuery->execute(array(':regexSup' => $regexSup));
            $textSup = $prepareQuery->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        // query for the different choices
        try {
            $query = "SELECT texte, id_texte FROM texte WHERE id_texte REGEXP :regex GROUP BY texte";
            $prepareQuery = $this->dataAccess->prepare($query);
            $regex = "^{$year}\d$";
            $prepareQuery->execute(array(':regex' => $regex));
            $choices = $prepareQuery->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        $arrayChoices = [];
        foreach ($choices as $choice) {
            $id_texte = $choice['id_texte'];

            // query for the options
            try {
                $query = "SELECT opt FROM option WHERE id_texte = :id_texte";
                $prepareQuery = $this->dataAccess->prepare($query);
                $prepareQuery->execute(array(':id_texte' => $id_texte));
                $options = $prepareQuery->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e->getMessage();
            }

            // create object Choice for each choice
            $arrayChoices[] = new Choice($choice['texte'], count($options), array_column($options, 'opt'));

        }

        // create object YearData with all the data concatenated
        return new YearData($year, count($textSup), explode(',', $textSup['textSup']), count($choices), $arrayChoices);
    }

    public function modifyChoice($idText, $text)
    {
        try {
            $query = "UPDATE texte SET texte=:text WHERE id_texte = :idText";
            $prepareQuery = $this->dataAccess->prepare($query);
            $prepareQuery->execute(array(':text' => $text, ':idText' => $idText));
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function modifyOpt($idOpt, $idText, $text)
    {
        try {
            $query = "UPDATE option SET opt=:text WHERE id_texte = :idText and id_opt = :idOpt";
            $prepareQuery = $this->dataAccess->prepare($query);
            $prepareQuery->execute(array(':text' => $text, ':idText' => $idText, ':idOpt' => $idOpt));
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function modifyTextSup($idTextSup, $text)
    {
        try {
            $query = "UPDATE texte SET texte=:text WHERE id_texte = :idTextSup";
            $prepareQuery = $this->dataAccess->prepare($query);
            $prepareQuery->execute(array(':text' => $text, ':idTextSup' => $idTextSup));
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}