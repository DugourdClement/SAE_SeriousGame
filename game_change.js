const editableElement = document.getElementById("text-1");
const text = editableElement.innerHTML;

document.forms[0].addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from being submitted

    // Add the text to the form data
    const formData = new FormData(this);
    formData.append('text', text);

    // Submit the form
    this.submit();
});