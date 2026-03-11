document.addEventListener('DOMContentLoaded', () => {
    var loaderContainer = document.getElementById('loader');

    // Get the modal
    var popup = document.getElementById("popup");
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        popup.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    }
});

function showPopup(message) {
    var popup = document.getElementById("popup");
    var popupMessage = document.getElementById("popup-message");
    popupMessage.textContent = message;
    popup.style.display = "block";
}

function generateResponse(fieldId,backText) {
    var field = document.getElementById(fieldId);
    var originalText = field.value.trim();
    var loader = document.getElementById('loader');

    // Validate input
    if (!originalText) {
        showPopup("The input field cannot be empty. Please enter some text.");
        return;
    }

    var improvedTextPrompt = "Improve text for a professional resume : " + originalText +' '+ backText;

    console.log("You : "+improvedTextPrompt);

    // Show loader
    loader.style.display = 'block';

    fetch("./live_res/response.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            text: improvedTextPrompt
        })
    })
    .then((res) => res.json())
    .then((res) => {
        // Hide loader
        loader.style.display = 'none';
        
        if (res.error) {
            showPopup(res.error);
        } else {
            field.value = res.text;
            console.log("AI : " + res.text)
        }
    })
    .catch((error) => {
        // Hide loader
        loader.style.display = 'none';

        console.error('Error:', error);
        showPopup("An error occurred while processing your request.");
    });
}