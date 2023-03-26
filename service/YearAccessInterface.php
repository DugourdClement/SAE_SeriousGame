<?php

interface YearAccessInterface {

    public function getYearData($year);

    public function modifyChoice($idText, $text);

    public function modifyOpt($idOpt, $idText, $text);

    public function modifyTextSup($idTextSup, $text);
}
