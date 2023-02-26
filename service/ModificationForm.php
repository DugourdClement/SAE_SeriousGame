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

    public function authenticate( $username, $password, $data )
    {
        $user = $data->isUser( $username, $password );
        return ( $user != null );
    }

    public function getAllForm( $data )
    {
        $this->modificationTxt = array();

        for ($i = 1; $i < 8; $i++){
            $this->modificationTxt[] = $data->getYearData($i);
        }
    }
}