<?php

class Controllers
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }

    public function authenticateAction($userChecking, $data, $postData, &$sessionData)
    {
        if (!isset($sessionData['login'])) {

            if (isset($postData['login']) && isset($postData['password'])) {
                $userChecking->authenticate($postData['login'], $postData['password'], $data);
                if (!$this->outputData->getOutputData()) {

                    return 'Mauvais identifiant ou mot de passe !';
                }
                $userChecking->verifyCaptcha($postData['g-recaptcha-response'], $data);
                if (!$this->outputData->getOutputData()) {

                    return 'Vous etes un robot !';
                }

                $sessionData['isLogged'] = true;
            } else {
                return 'Veuillez remplir tous les champs !';
            }
        }
    }
    public function modificationAction($yearChecking, $data, $postData)
    {
        if (isset($postData['text']) && (isset($postData['idText']) || isset($postData['idTextSup']))) {            // if it's an option
            if (isset($postData['idOpt']))
                $data->modifyOpt($postData['idOpt'], $postData['idText'], $postData['text']);
            // if it's a text sup
            elseif (isset($postData['idTextSup']))
                $data->modifyTextSup($postData['idTextSup'], $postData['text']);
            // if it's a choice
            else
                $data->modifyChoice($postData['idText'], $postData['text']);
        }
        else {
            $yearChecking->getYearsData($data);
        }
    }

    public function gameAction($gameCheking, $data)
    {
        $gameCheking->getYearsData($data);
    }
}
