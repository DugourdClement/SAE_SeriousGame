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

    function verifyCaptcha($response)
    {
        $secret = '6Ld2ZfskAAAAAN-2wZhy7I8PkmVB0i1l9qq06AO1';
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $secret,
            'response' => $response,
        );

        $options = array(
            'http' => array(
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        return $response['success'];
    }

    function isUser($username, $password)
    {
        try {
            $query = "SELECT mdp FROM utilisateur WHERE identifiant = :username";
            $prepareQuery = $this->dataAccess->prepare($query);
            $prepareQuery->execute(array(':username' => $username));
            $user = $prepareQuery->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        if (password_verify($password, $user['mdp']))
            return true;
        else
            return false;
    }
}