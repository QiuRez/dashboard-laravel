$(document).click(function(e) {

    var dropdown = document.querySelector('.dropdown-menu');
    if ($(e.target).closest('.dropdown-toggle').length) {
        dropdown.classList.toggle('active')
    } else {
        dropdown.classList.remove('active')
    }

})

function userEdit(event) {

    var tds = $(event).parent('td').siblings('td').not('.has-image, .has-role');

    if ($(event).hasClass('btn-fake')) {
        $(event).siblings('button[class=btn-cancel]').fadeIn(0);
        $(event).siblings('a[class=ban-or-unban]').fadeOut(0);
        $(event).siblings('button[class=button-edit]').fadeIn(0);
        $(event).fadeOut(0);

        tds.children('p').fadeOut(0);
        tds.children('input').fadeIn(0);
    } 


    if ($(event).hasClass('btn-cancel')) {
        $(event).siblings('button[class=btn-fake]').fadeIn(0);
        $(event).siblings('button[class=button-edit]').fadeOut(0);
        $(event).siblings('a[class=ban-or-unban]').fadeIn(0);
        $(event).fadeOut(0);

        tds.children('p').fadeIn(0);
        tds.children('input').fadeOut(0);
    }
}

