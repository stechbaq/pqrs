$(document).ready(() => {
    
    $("#btnLogout").on('click', () => {
        window.location.href = '../API/services/account/logout.php'
    })

})