$(document).click(function(e) {

    var dropdown = document.querySelector('.dropdown-menu');
    if ($(e.target).closest('.dropdown-toggle').length) {
        dropdown.classList.toggle('active')
    } else {
        dropdown.classList.remove('active')
    }
})

