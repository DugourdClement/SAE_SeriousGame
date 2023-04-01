<?php
include_once "View.php";

class ViewChatbot extends View
{

    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Chatbot';

        $this->content = '
            <script src="https://unpkg.com/@babel/polyfill@7.6.0/dist/polyfill.min.js"></script>
            <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
            
            <script src="/sae/gui/js/conversation.js"></script>
            <script type="text/babel" data-presets="es2015,es2016,es2017" src="/sae/gui/js/chatbot.js"></script>
            
            <div class="home" id="home">
                <div class="chat-bot">
                    <div class="text-center">
                        <h5 class="xl reset-margin large-margin">CHATBOT</h5>
                        <p>Avez-vous besoin d \'aide ? </p>
                        <p>Je suis à votre disposition pour vous proposez des références pour approfondir les
                            sujets abordés prédement dans notre serious game. Veuillez sélectionner une réponse à chaque question
                            posée.</p>
                    </div>
                    
                    
                        <div id="chatbot-container">
                            <div id="chatbot-inner">
                                <div id="chatbot"></div>
                            </div>
                        </div>
                    
                </div>
            </div>';
        }
}