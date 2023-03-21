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

                $_SESSION['isLogged'] = true;
            } else {
                return 'Veuillez remplir tous les champs !';
            }
        }
    }

    public function modificationAction($yearChecking, $data)
    {
        $yearChecking->getYearsData($data);
    }

    public function gameAction($gameCheking, $data)
    {
        $gameCheking->getYearsData($data);
    }
}