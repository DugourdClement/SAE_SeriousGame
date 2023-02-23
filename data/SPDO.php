<?php

final class SPDO
{
    private ?PDO $PDOInstance = null;
    private static ?SPDO $instance = null;

    private function __construct()
    {
        define("CHEMIN_VERS_FICHIER_INI", 'config.ini');
        define("BASE_DE_DONNEES", 'serious_bd');
        $A_config = parse_ini_file(CHEMIN_VERS_FICHIER_INI, true);
        if (is_array($A_config)) {
            $A_config = $A_config['serveur_admin'];
            $S_dsn = $A_config['type'] . ':dbname=' . BASE_DE_DONNEES . ';host=' . $A_config['adresse_IP'] . ';port=3306';
            $this->PDOInstance = new PDO($S_dsn, $A_config['utilisateur'], $A_config['motdepasse']);
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new SPDO();
        }
        return self::$instance;
    }

    public function query($query)
    {
        return $this->PDOInstance->query($query);
    }

    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }

    public function get_result(){
        return $this->PDOInstance->get;
    }
}