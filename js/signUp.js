$(document).ready(() => {
    
    $("form").submit((e) => {
        e.preventDefault()
        initialize()
        let fullname = $("#fullname").val()
        let username = $("#username").val()
        let password = $("#pass").val()
        let confirmationPassword = $("#pass_confirmation").val()

        if (password === confirmationPassword) {
            $("#btnSignUp").css({"display" : "none"})
            $("#btnGoToSignIn").css({"display" : "none"})
            $("#sending").css({"display" : "block"})

            $.ajax({
                url: 'API/services/account/signUp.php',
                type: 'POST',
                data: {
                    'fullname': fullname,
                    'username': username,
                    'password': password
                },
                success: (response) => {
                    initialize()
                    if (response.code === 1) {
                        $("#success").css({"display" : "block"})
                        setTimeout(() => {
                            window.location.href = "signIn"
                        }, 2000)
                    } else {
                        $("#btnSignUp").css({"display" : "block"})
                        $("#btnGoToSignIn").css({"display" : "block"})
                        $("#reject").html("<span>" + response.message + "</span>")
                        $("#reject").css({"display" : "block"})
                    }
                },
                error: (xhr, status) => {
                    
                }
            })

        } else {
            $("#inconsistency").css({"display" : "block"})
        }

    })

    function initialize() {
        $("#sending").css({"display" : "none"})
        $("#reject").css({"display" : "none"})
        $("#inconsistency").css({"display" : "none"})
        $("#success").css({"display" : "none"})
    }

    $("#fullname").focus();

})