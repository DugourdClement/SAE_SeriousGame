<?php

interface DataAccessInterface {

    public function getYearData($year);

    public function isUser($username, $password);

}
