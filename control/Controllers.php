<?php

class Controllers
{
    public function modificationAction($login, $password, $response, $data, $yearDataAccess)
    {
        if( $yearDataAccess->authenticate($login, $password, $response, $data)) {

            $_SESSION['username'] = $login; //maybe need to put it in ViewModification.php
            $_SESSION['isLogin'] = true;

            $yearDataAccess->getYearData($data);
        }
    }

    public function gameAction($data, $yearDataAccess)
    {
        if (isset($_POST['functionName'])) {

            $functionName = $_POST['functionName'];
            if ($functionName == 'gameAction') {

                echo json_encode($yearDataAccess->getYearsData($data));
            }
        }
    }
}