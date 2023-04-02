<?php

final class SPDO
{
    private ?PDO $PDOInstance = null;
    private static ?SPDO $instance = null;
    private string $serverName;

    private function __construct(string $serverName)
    {
        define("CHEMIN_VERS_FICHIER_INI", 'config.ini');
        define("BASE_DE_DONNEES", 'serious_bd');
        $config = parse_ini_file(CHEMIN_VERS_FICHIER_INI, true);
        if (isset($config[$serverName])) {
            $serverConfig = $config[$serverName];
            $dsn = $serverConfig['type'] . ':dbname=' . BASE_DE_DONNEES . ';host=' . $serverConfig['adresse_IP'] . ';port=' . $serverConfig['port'];
            $this->PDOInstance = new PDO($dsn, $serverConfig['utilisateur'], $serverConfig['motdepasse']);
            $this->serverName = $serverName;
        } else {
            throw new Exception("Server '$serverName' not found in config file");
        }
    }

    public static function getInstance(string $serverName = 'serveur_admin'): SPDO
    {
        if(is_null(self::$instance) || self::$instance->serverName !== $serverName)
        {
            self::$instance = new SPDO($serverName);
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
}
