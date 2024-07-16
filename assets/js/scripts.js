document.addEventListener('DOMContentLoaded', function() {
    var modale = document.getElementById('contact-modale');
    var span = document.getElementsByClassName('close')[0];
    
    document.getElementById('contact-link').onclick = function(event) {
        event.preventDefault();
        modale.style.display = 'block';
    }
    
    span.onclick = function() {
        modale.style.display = 'none';
    }
    
    window.onclick = function(event) {
        if (event.target == modale) {
            modale.style.display = 'none';
        }
    }
});
