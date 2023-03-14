<?php

interface DataAccessInterface {

    public function getYearData($year);

    function verifyCaptcha($response);
    public function isUser($username, $password);

}
