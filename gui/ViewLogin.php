<?php
include_once "View.php";

class ViewLogin extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Connexion';

        $this->content = '
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

            <div class="home" id="home">
                <div class="connexion">
                    <p class="login">Se connecter</p>
                    <form id="formLogin" method="post" action="/sae/index.php/modification">
                        <input type="text" class="champLogin" id="login" name="login" placeholder="Nom d\'utilisateur" required>
                        <input type="password" class="champLogin" id="password" name="password" placeholder="Mot de passe" required>
                        <div class="g-recaptcha" data-sitekey="6Ld2ZfskAAAAAFRpqlfYt-zgWCJ1IyGPYl_s8LXc"></div>
                        <button id="submitLogin" type="submit" class="submit" name="submit-button" value="1">Envoyer</button>
                    </form>
                </div>
            </div>';
    }
}