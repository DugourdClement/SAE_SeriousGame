<?php
use PHPUnit\Framework\TestCase;

class testsUnitairesControllers extends TestCase
{
    public function testModificationAction()
    {
        // Créer un objet de la classe Controllers
        $controllers = new Controllers();

        // Simuler les données nécessaires pour l'exécution de la fonction
        $login = 'john_doe';
        $password = 'password123';
        $data = ['name' => 'John Doe', 'email' => 'john@example.com'];
        $modificationForm = $this->getMockBuilder(ModificationForm::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Définir les attentes pour la méthode authenticate() du Mock de ModificationForm
        $modificationForm->expects($this->once())
            ->method('authenticate')
            ->with($this->equalTo($login), $this->equalTo($password), $this->equalTo($data))
            ->willReturn(true);

        // Exécuter la fonction à tester
        $controllers->modificationAction($login, $password, $data, $modificationForm);

        // Vérifier que les sessions ont été initialisées correctement
        $this->assertEquals($login, $_SESSION['username']);
        $this->assertTrue($_SESSION['isLogin']);

        // Vérifier que la méthode getAllForm() de $modificationForm a été appelée une fois avec $data en argument
        $modificationForm->expects($this->once())
            ->method('getAllForm')
            ->with($this->equalTo($data));
    }
}