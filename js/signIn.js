$(document).ready(() => {

    $("#btnGoToSignUp").on("click", (e) => {
        window.location.href = "signUp"
    })

    $("form").submit((e) => {
        e.preventDefault()
        initialize()
        let username = $("#username").val()
        let password = $("#pass").val()

        $("#btnSignIn").prop('disabled', true)
        $("#btnGoToSignUp").prop('disabled', true)

        $.ajax({
            url: 'API/services/account/signIn.php',
            type: 'POST',
            data: {
                'username': username,
                'password': password
            },
            success: (response) => {
                if (response.code === 1) {
                    window.location.href = "app/principal"
                } else {
                    initialize()
                    $("#reject").html("<span>" + response.message + "</span>")
                    $("#reject").css({"display" : "block"})
                }
            },
            error: (xhr, status) => {
                initialize()
            }
        })
        
    })

    function initialize() {
        $("#btnSignIn").prop('disabled', false)
        $("#btnGoToSignUp").prop('disabled', false)
        $("#sending").css({"display" : "none"})
        $("#reject").css({"display" : "none"})
    }

    $("#username").focus()
})