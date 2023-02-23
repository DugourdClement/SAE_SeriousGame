<?php
include_once "View.php";

class ViewModification extends View
{

    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'Modification des données';

        $this->content = '
                    <script defer src="js/game_change.js"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <header>
                        <div class="logo"><a href="index.php"><img id="logoManette" src="gui/Picture/site/logosae.png"
                                                                   alt=" retour en haut "></a></div>
                    </header>
                    
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

        $this->content = $presenter->getAllFormHTML();
    }
}