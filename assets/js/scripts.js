document.addEventListener('DOMContentLoaded', function() {
    var modale = document.getElementById('contact-modale');
    var contactLink = document.getElementById('contact-link');
    
    // Ouvrir la modale au clic sur le lien "Contact"
    if (contactLink) {
        contactLink.onclick = function(event) {
            event.preventDefault();
            modale.style.display = 'block';
        }
    }

    // Fermer la modale en cliquant n'importe où sur la page
    window.onclick = function(event) {
        if (event.target == modale) {
            modale.style.display = 'none';
        }
    }
});
