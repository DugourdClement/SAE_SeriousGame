<?php
use PHPUnit\Framework\TestCase;

require_once 'data/YearSqlAccess.php';

class YearSqlAccessTest extends TestCase
{
    protected $yearSqlAccess;

    protected function setUp(): void
    {
        $dataAccess = new PDO('mysql:host=localhost;dbname=test', 'username', 'password'); // Changer le driver
        $this->yearSqlAccess = new YearSqlAccess($dataAccess);
    }

    public function testGetYearData()
    {
        $yearData = $this->yearSqlAccess->getYearData(2022);

        $this->assertInstanceOf('YearData', $yearData);
        $this->assertEquals(2, count($yearData->getTextSup()));
        $this->assertEquals('Texte Sup 1', $yearData->getTextSup()[0]);
        $this->assertEquals(3, count($yearData->getChoices()));
        $this->assertEquals(1, count($yearData->getChoices()[0]->getOptions()));
        $this->assertEquals(['Option 1'], $yearData->getChoices()[0]->getOptions());
    }

    public function testModifyChoice()
    {
        $originalText = 'Choice Text';
        $updatedText = 'Updated Choice Text';
        $idText = 1; // Remplacer par un ID réel dans votre base de données

        $this->yearSqlAccess->modifyChoice($idText, $updatedText);

        // Récupérer les données mises à jour de la base de données
        $yearData = $this->yearSqlAccess->getYearData(2022);
        $choice = $yearData->getChoices()[0]; // Adapter l'index en fonction de la position du choix modifié dans les données
        $this->assertEquals($updatedText, $choice->getText());
    }

    public function testModifyOpt()
    {
        $originalText = 'Option Text';
        $updatedText = 'Updated Option Text';
        $idOpt = 1; // Remplacer par un ID réel dans votre base de données
        $idText = 1; // Remplacer par un ID réel dans votre base de données

        $this->yearSqlAccess->modifyOpt($idOpt, $idText, $updatedText);

        // Récupérer les données mises à jour de la base de données
        $yearData = $this->yearSqlAccess->getYearData(2022);
        $option = $yearData->getChoices()[0]->getOptions()[0]; // Adaptez les index en fonction de la position de l'option modifiée dans les données
        $this->assertEquals($updatedText, $option);
    }

    public function testModifyTextSup()
    {
        $originalText = 'Text Sup';
        $updatedText = 'Updated Text Sup';
        $idTextSup = 20220; // Remplacer par un ID réel dans votre base de données

        $this->yearSqlAccess->modifyTextSup($idTextSup, $updatedText);

        // Récupérer les données mises à jour de la base de données
        $yearData = $this->yearSqlAccess->getYearData(2022);
        $textSup = $yearData->getTextSup()[0]; // Adaptez l'index en fonction de la position du texte modifié dans les données
        $this->assertEquals($updatedText, $textSup);
    }
}