<?php

class Controllers
{
    protected $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }
    public function authenticateAction($userChecking, $data)
    {
        if (!isset($_SESSION['login'])) {

            if (isset($_POST['login']) && isset($_POST['password'])) {
                $userChecking->authenticate($_POST['login'], $_POST['password'], $data);
                if (!$this->outputData->getOutputData()) {

                    return 'Mauvais identifiant ou mot de passe !';
                }
                $userChecking->verifyCaptcha($_POST['g-recaptcha-response'], $data);
                if (!$this->outputData->getOutputData()) {

                    return 'Vous etes un robot !';
                }

                $_SESSION['login'] = $_POST['login'];
            } else {
                return 'Veuillez remplir tous les champs !';
            }
        }
    }

    public function modificationAction($yearChecking, $data)
    {
        $yearChecking->getYearsData($data);
    }

    public function gameAction($yearDataAccess, $data)
    {
        if (isset($_POST['functionName'])) {

            $functionName = $_POST['functionName'];
            if ($functionName == 'gameAction') {

                echo json_encode($yearDataAccess->getYearsData($data));
            }
        }
    }
}