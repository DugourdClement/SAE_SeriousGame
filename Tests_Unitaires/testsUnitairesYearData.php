<?php
use PHPUnit\Framework\TestCase;

class testsUnitairesYearData extends TestCase
{
    public function testConstruct()
    {
        $year = 2022;
        $nbTextSup = 2;
        $textSup = array('Texte supplémentaire 1', 'Texte supplémentaire 2');
        $nbChoices = 3;
        $choices = array('Choix 1', 'Choix 2', 'Choix 3');

        $test = new YearData($year, $nbTextSup, $textSup, $nbChoices, $choices);
    

        $this->assertEquals($year, $test->year);
        $this->assertEquals($nbTextSup, $test->nbTextSup);
        $this->assertEquals($textSup, $test->textSup);
        $this->assertEquals($nbChoices, $test->nbChoices);
        $this->assertEquals($choices, $test->choices);
    }

    public function testGetYear()
    {
        $test = new YearData(2022, 2, array('Texte supplémentaire 1', 'Texte supplémentaire 2'), 3, array('Choix 1', 'Choix 2', 'Choix 3'));

        $this->assertEquals(2022, $test->getYear());
    }

    public function testGetNbTextSup()
    {
        $test = new YearData(2022, 2, array('Texte supplémentaire 1', 'Texte supplémentaire 2'), 3, array('Choix 1', 'Choix 2', 'Choix 3'));

        $this->assertEquals(2, $test->getNbTextSup());
    }

    public function testGetTextSup()
    {
        $test = new YearData(2022, 2, array('Texte supplémentaire 1', 'Texte supplémentaire 2'), 3, array('Choix 1', 'Choix 2', 'Choix 3'));

        $this->assertEquals(array('Texte supplémentaire 1', 'Texte supplémentaire 2'), $test->getTextSup());
    }

    public function testGetNbChoices()
    {
        $test = new YearData(2022, 2, array('Texte supplémentaire 1', 'Texte supplémentaire 2'), 3, array('Choix 1', 'Choix 2', 'Choix 3'));

        $this->assertEquals(3, $test->getNbChoices());
    }

    public function testGetChoices()
    {
        $test = new YearData(2022, 2, array('Texte supplémentaire 1', 'Texte supplémentaire 2'), 3, array('Choix 1', 'Choix 2', 'Choix 3'));

        $this->assertEquals(array('Choix 1', 'Choix 2', 'Choix 3'), $test->getChoices());
    }

    public function testJsonSerialize()
    {
        $test = new YearData(2022, 2, array('Texte supplémentaire 1', 'Texte supplémentaire 2'), 3, array('Choix 1', 'Choix 2', 'Choix 3'));

        $json = $test->jsonSerialize();

        $this->assertEquals(2022, $json['year']);
        $this->assertEquals(2, $json['nbTextSup']);
        $this->assertEquals(array('Texte supplémentaire 1', 'Texte supplémentaire 2'), $json['textSup']);
        $this->assertEquals(3, $json['nbChoice']);
        $this->assertEquals(array('Choix 1', 'Choix 2', 'Choix 3'), $json['choice']);
    }

}

