<?php
include_once "View.php";

class ViewModification extends View
{

    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        if( $presenter->getAllFormHTML() == null ){ //change this to display the error message and not use the header
            header( "refresh:5;url=/sae/index.php/connection" );
            echo 'Erreur de login et/ou de mot de passe (redirection automatique dans 5 sec.)';
            exit;
        }

        $this->title = 'Modification des données';

        $this->content = '
                    <header>
                     
                    </header>
                    <div id="modifContainer">
                        <div id="change">
                            <p id="banner">Modification enregistée</p>
                            <label for="menu">Choisir une année à modifier : </label><br>
                            <select name="menu" id="menu">
                                <option value="base">---</option>
                                <option value="option1">Année 2022</option>
                                <option value="option2">Année 2032</option>
                                <option value="option3">Année 2035</option>
                                <option value="option4">Année 2039</option>
                                <option value="option5">Année 2043</option>
                                <option value="option6">Année 2050</option>
                                <option value="option7">Année 2056</option>
                            </select>
                         </div>';

        $this->content .= $presenter->getAllFormHTML();

        $this->content .= '
                    </div>
                    <script defer src="/sae/gui/js/game_change.js?v=1"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
    }
}