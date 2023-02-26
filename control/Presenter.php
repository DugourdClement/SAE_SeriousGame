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
            $y = 1;
            foreach ($this->modificationCheck->getModificationTxt() as $yearData) {

                $nbChoice = $yearData->getNbChoices() + 1;

                $content .= '<div class="form" id="form"' . $y . ' style="display: none;">'; //One form to rule them all

                $choices = $yearData->getChoices();
                for ($c = 1; $c < $nbChoice; ++$c) { //One content-editable for the choice
                    $content .= '
                        <form action="ViewModification.php" method="POST" id="form_' . $y . $c . '">
                        <p id="text_' . $y . $c . '" contenteditable>' . $choices[$c - 1]->getChoice() . '</p>
                        <button  class="submit" id="btnSubmit_' . $y . $c . '" type="submit" name="btnSubmit" form="form_' . $y . $c . '"> Valider</button>
                        </form>';

                    for ($o = 1; $o < $choices[$c - 1]->getNbOpt() + 1; ++$o) { //Four or less content-editable for the options
                        $content .= '
                            <form action="ViewModification.php" method="POST" id="form_' . $y . $c . $o . '">
                            <p id="text_' . $y . $c . $o . '" contenteditable>' . $choices[$c - 1]->getOpt() . '</p>
                            <button  class="submit" id="btnSubmit_' . $y . $c . $o . '" type="submit" name="btnSubmit" form="form_' . $y . $c . $o . '"> Valider</button>
                            </form>';
                    }
                }

                $textSup = $yearData->getTextSup();
                for ($t = 1; $t < $yearData->getNbTextSup() + 1; ++$t) { //Additional content-editable for the textSup
                    $content .= '
                        <form action="ViewModification.php" method="POST" id="form_' . $y . '0' . $t . '">
                        <p id="text_' . $y . '0' . $t . '" contenteditable>' . $textSup[$t] . '</p>
                        <button  class="submit" id="btnSubmit_' . $y . '0' . $t . '" type="submit" name="btnSubmit" form="form_' . $y . '0' . $t . '"> Valider</button>
                        </form>';
                }

                $content .= '</div>';
                ++$y;
            }


            return $content;
        }
    }
}