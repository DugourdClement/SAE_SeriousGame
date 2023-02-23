<?php
include_once "View.php";

class ViewLogin extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Connexion';

        $this->content = '
            <div class="home" id="home">
                <div class="connexion">
                    <p class="sign">Se connecter</p>
                    <form method="post">
                        <input type="text" class="champ" id="username" name="username" placeholder="Nom d\'utilisateur" required>
                        <input type="password" class="champ" id="password" name="password" placeholder="Mot de passe" required>
                        <button type="submit" class="submit" name="submit-button" value="1">Envoyer</button>
                    </form>
                </div>
            </div>';
    }
}