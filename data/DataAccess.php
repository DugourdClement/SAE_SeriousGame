<?php
require 'domain/YearData.php';
require 'domain/Choice.php';
require 'service/DataAccessInterface.php';

class DataAccess implements DataAccessInterface
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
            $query = "SELECT COUNT(*) as nbTextSup, GROUP_CONCAT(texte SEPARATOR ', ') as textSup FROM texte WHERE id_texte REGEXP :regexSup";
            $prepareQuery = $this->dataAccess->prepare($query);
            $regexSup = "^" . $year . "0\d$";
            $prepareQuery->execute(array(':regexSup' => $regexSup));
            $textSup = $prepareQuery->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        // query for the different choices
        try {
            $query = "SELECT COUNT(*) as nbChoice, id_texte, texte FROM texte WHERE id_texte REGEXP :regex";
            $prepareQuery = $this->dataAccess->prepare($query);
            $regex = "^" . $year . "\d$";
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
                $query = "SELECT COUNT(*) as nbOpt, GROUP_CONCAT(opt SEPARATOR ', ') as opts FROM option WHERE id_texte = :id_texte";
                $prepareQuery = $this->dataAccess->prepare($query);
                $prepareQuery->execute(array(':id_texte' => $id_texte));
                $options = $prepareQuery->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e->getMessage();
            }

            // create object Choice for each choice
            $arrayChoices[] = new Choice($choice['texte'], $options[0]['nbOpt'], explode(', ', $options[0]['opts']));
        }

        // create object YearData with all the data concatenated
        return new YearData($year, $textSup["nbTextSup"], explode(',', $textSup['textSup']), $choices[0]["nbChoice"], $arrayChoices);
    }

    function isUser($username, $password)
    {
        try {
            $query = "SELECT COUNT(*) as nbUser FROM utilisateur WHERE identifiant = :username AND mdp = :password";
            $prepareQuery = $this->dataAccess->prepare($query);
            $prepareQuery->execute(array(':username' => $username, ':password' => $password));
            $user = $prepareQuery->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        if ($user['nbUser'] == 1)
            return true;
        else
            return false;
    }
}