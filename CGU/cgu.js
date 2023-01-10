const accepter = document.getElementById('accepter');
accepter.addEventListener('click', closeWindow);

let opened;
function openPopup() {
    opened =  window.open("CGU/cguinsta.html", "Popup", "width=800,height=700");
}

function closeWindow() {
    window.close();
}
