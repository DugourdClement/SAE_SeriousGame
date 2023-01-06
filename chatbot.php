<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Chatbot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Css/chatbot.css">
      <link rel="icon" type="image/png" sizes="16x16" href="Picture/site/icone.png">
    <script src="https://unpkg.com/@babel/polyfill@7.6.0/dist/polyfill.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="conversation.js"></script>
    <script type="text/babel" data-presets="es2015,es2016,es2017" src="chatbot.js"></script>

  </head>
  <body>

  <header class="text-center">
      <h1 class="xl reset-margin large-margin">CHATBOT</h1>
      <p>Avez-vous besoin d'aide ? </p>
      <p>Promis, je suis un humain et je suis là pour vous proposez des oeuvres si vous souhaitez vous renseigner sur des sujets que nous avons abordé dans notre serious game. Veuillez sélectionner une réponse à chaque question posée.</p>
    </header>

    <main id="main">
      <div id="chatbot-container">
        <div id="chatbot-inner">
          <div id="chatbot"></div>
        </div>
      </div>
    </main>

  </body>
</html>