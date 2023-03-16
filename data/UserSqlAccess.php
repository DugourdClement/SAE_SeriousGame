<?php
include_once 'service/UserAccessInterface.php';

class UserSqlAccess implements UserAccessInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function __destruct()
    {
        $this->dataAccess = null;
    }

    function isUser($login, $password)
    {
        try {
            $query = "SELECT mdp FROM utilisateur WHERE identifiant = :username";
            $prepareQuery = $this->dataAccess->prepare($query);
            $prepareQuery->execute(array(':username' => $login));
            $user = $prepareQuery->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        if (password_verify($password, $user['mdp']))
            return true;
        else
            return false;
    }

    function verifyCaptcha($response)
    {
        $secret = '6Ld2ZfskAAAAAN-2wZhy7I8PkmVB0i1l9qq06AO1';
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $secret,
            'response' => $response,
        );

        $options = array(
            'http' => array(
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        return $response['success'];
    }
}