<?php
include_once "View.php";

class ViewLogin extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Connexion';

        $this->content = '
            <div class="window" id="home">
                <div class="connexion">
                    <p class="login">Se connecter</p>
                    <form id="formLogin" method="post" action="/sae/index.php/modification">
                        <input type="text" class="champLogin" id="username" name="username" placeholder="Nom d\'utilisateur" required>
                        <input type="password" class="champLogin" id="password" name="password" placeholder="Mot de passe" required>
                        <button id="submitLogin" type="submit" class="submit" name="submit-button" value="1">Envoyer</button>
                    </form>
                </div>
            </div>';
    }
}