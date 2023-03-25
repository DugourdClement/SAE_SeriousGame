<?php
use PHPUnit\Framework\TestCase;

class testsUnitairesYearData extends TestCase
{

    public function testCanBeCreatedFromValidData(): void
    {
        $year = 2022;
        $nbTextSup = 5;
        $textSup = ['text1', 'text2', 'text3'];
        $nbChoices = 3;
        $choices = [
            new Choice('choice1', 2, ['option1', 'option2']),
            new Choice('choice2', 3, ['option1', 'option2', 'option3']),
            new Choice('choice3', 1, ['option1']),
        ];

        $yearData = new YearData($year, $nbTextSup, $textSup, $nbChoices, $choices);

        $this->assertInstanceOf(YearData::class, $yearData);
        $this->assertEquals($year, $yearData->getYear());
        $this->assertEquals($nbTextSup, $yearData->getNbTextSup());
        $this->assertEquals($textSup, $yearData->getTextSup());
        $this->assertEquals($nbChoices, $yearData->getNbChoices());
        $this->assertEquals($choices, $yearData->getChoices());
    }

}

