<?php

class ModificationForm
{
    protected $modificationTxt;

    /**
     * @return mixed
     */
    public function getModificationTxt()
    {
        return $this->modificationTxt;
    }

    public function authenticate( $login, $password, $data )
    {
        $user = $data->getUser( $login, $password );
        return ( $user != null );
    }

    public function getAllForm( $data )
    {
        $this->modificationTxt = array();

        for ($i = 0; $i < 7; $i++){
            $this->modificationTxt[] = $data->getYearData($i);
        }
    }
}