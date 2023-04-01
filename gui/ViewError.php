<?php
include_once "View.php";

class ViewError extends View
{
    public function __construct($layout, $error, $redirect)
    {
        parent::__construct($layout);

        header("refresh:2;url=$redirect");

        $this->title = 'Erreur';

        $this->content = '
                        <div class="home" id="home">
                            <div class="error-message">
                                <h3>' . $error . '</h3>
                            </div>
                        </div>';
    }
}