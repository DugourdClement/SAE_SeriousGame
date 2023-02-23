<?php

class Controllers
{
    public function modificationAction($login, $password, $data, $modificationForm)
    {
        if( $modificationForm->authenticate($login, $password, $data) ) {

            $modificationForm->getAllForm($data);
        }
    }
}