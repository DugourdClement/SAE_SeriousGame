<?php

class Controllers
{
    public function modificationAction($login, $password, $data, $modificationForm)
    {
        if( $modificationForm->authenticate($login, $password, $data) ) {

            $_SESSION['username'] = $login; //maybe need to put it in ViewModification.php
            $_SESSION['isLogin'] = true;

            $modificationForm->getAllForm($data);
        }
    }
}