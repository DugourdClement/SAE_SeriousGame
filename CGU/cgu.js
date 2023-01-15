const accepter = document.getElementById('accepter');
accepter.addEventListener('click', closeWindow);

//not supported by all browser so the 2 mariniere are necessary, and different browsers may display the message differently or may ignore the message entirely.
window.addEventListener('beforeunload', function(e) {
    e.returnValue = "Cliquez sur le bouton en bas de page pour les accepté";
});

window.onbeforeunload = function(){
    return "Cliquez sur le bouton en bas de page pour les accepté";
}

function closeWindow() {
    window.close();
}
