<?php

class Presenter
{
    protected $modificationCheck;

    public function __construct($annoncesCheck)
    {
        $this->modificationCheck = $annoncesCheck;
    }

    public function getAllFormHTML()
    {
        $content = null;

        if ($this->modificationCheck->getModificationTxt() != null) {
            foreach ($this->modificationCheck->getModificationTxt()() as $yearContent) {
                for ($y = 0; $y < 7; $y++) {
                    $nbChoice = $yearContent["nbChoice"] + 1;

                    $content .= '<div class="form" id="form"' . $y . ' style="display: none;">'; //One form to rule them all

                    for ($c = 1; $c < $nbChoice; ++$c) { //One content-editable for the choice
                        $choices = $yearContent . getChoices();
                        $content .= '
                        <form action="ViewModification.php" method="POST" id="form_' . $y . $c . '">
                        <p id="text_' . $y . $c . '" contenteditable>' . $choices[$c - 1] . getChoice() . '</p>
                        <button  class="submit" id="btnSubmit_' . $y . $c . '" type="submit" name="btnSubmit" form="form_' . $y . $c . '"> Valider</button>
                        </form>';

                        for ($o = 1; $o < $choices[$c - 1] . getNbOpt() + 1; ++$o) { //Four content-editable for the options
                            $content .= '
                            <form action="ViewModification.php" method="POST" id="form_' . $y . $c . $o . '">
                            <p id="text_' . $y . $c . $o . '" contenteditable>' . $choices[$c - 1] . getOpt() . '</p>
                            <button  class="submit" id="btnSubmit_' . $y . $c . $o . '" type="submit" name="btnSubmit" form="form_' . $y . $c . $o . '"> Valider</button>
                            </form>';
                        }
                    }

                    for ($t = 1; $t < $yearContent["nbTextSup"] + 1; ++$t) { //Additional content-editable for the textSup
                        $textSup = $yearContent . getTextSup();
                        $content .= '
                        <form action="ViewModification.php" method="POST" id="form_' . $y . '0' . $t . '">
                        <p id="text_' . $y . '0' . $t . '" contenteditable>' . $textSup[$t] . '</p>
                        <button  class="submit" id="btnSubmit_' . $y . '0' . $t . '" type="submit" name="btnSubmit" form="form_' . $y . '0' . $t . '"> Valider</button>
                        </form>';
                    }

                    $content .= '</div>';
                }
            }

            return $content;
        }
    }
}