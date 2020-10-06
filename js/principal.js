$(document).ready(() => {

    $("#pqrSaveForm").submit((e) => {
        e.preventDefault()
        initialize()
        let type = $("#pqr_type").val()
        let issue = $("#issue").val()
        let userId = $("#pqr_user option:selected").val()
        let username = $("#pqr_user option:selected").text()

        $(".actions-block").css({"display" : "none"})
        $(".sending").css({"display" : "block"})

        $.ajax({
            url: '../API/services/pqrs/create.php',
            type: 'POST',
            data: {
                'type': type,
                'issue': issue,
                'userId': userId,
                'username': username
            },
            success: (response) => {
                initialize()
                if (response.code === 1) {
                    $(".success").css({"display" : "block"})
                    setTimeout(() => {
                        reset()
                        window.location.href = ""
                    }, 2000)
                } else {
                    alert(response.message)
                }
            },
            error: (xhr, status) => {
                
            }
        })

    })

    $("#pqrEditForm").submit((e) => {
        e.preventDefault()
        initialize()
        let id = $("#pqr_id").val()
        let newStatus = $("#pqr_new_status option:selected").val()

        $(".actions-block").css({"display" : "none"})
        $(".sending").css({"display" : "block"})

        $.ajax({
            url: '../API/services/pqrs/update.php',
            type: 'POST',
            data: {
                'id': id,
                'newStatus': newStatus
            },
            success: (response) => {
                initialize()
                if (response.code === 1) {
                    $(".success").css({"display" : "block"})
                    setTimeout(() => {
                        reset()
                        window.location.href = ""
                    }, 2000)
                } else {
                    alert(response.message)
                }
            },
            error: (xhr, status) => {
                
            }
        })

    })

    $("#pqrDeleteForm").submit((e) => {
        e.preventDefault()
        initialize()
        let id = $("#pqr_id").val()

        $(".actions-block").css({"display" : "none"})
        $(".sending").css({"display" : "block"})

        $.ajax({
            url: '../API/services/pqrs/delete.php',
            type: 'POST',
            data: {
                'id': id
            },
            success: (response) => {
                initialize()
                if (response.code === 1) {
                    $(".success").css({"display" : "block"})
                    setTimeout(() => {
                        reset()
                        window.location.href = ""
                    }, 2000)
                } else {
                    alert(response.message)
                }
            },
            error: (xhr, status) => {
                
            }
        })

    })

    $("#pqrFormModal").on('show.bs.modal', (e) => {
        reset()
    })

    $("#pqrEditModal").on('show.bs.modal', (e) => {
        var $control = $(e.relatedTarget)
        var $id = $control.data("id")
        var $status = $control.data("status")

        let option = ""
        let currentStatus = 'Cerrado'
        if ($status === 'NEW') {
            currentStatus = 'Nuevo'
            option += "<option value='EXECUTION' selected>En ejecución</option>"
        } else if ($status === 'EXECUTION') {
            currentStatus = 'En ejecución'
            option += "<option value='CLOSED' selected>Cerrado</option>"
        }

        $("#pqr_id").val($id)
        $("#pqr_current_status").html("<span>" + currentStatus + "<span>")
        $("#pqr_new_status").html(option)
    })

    $("#pqrDeleteModal").on('show.bs.modal', (e) => {
        var $control = $(e.relatedTarget)
        var $id = $control.data("id")

        $("#pqr_id").val($id)
    })

    function initialize() {
        $(".sending").css({"display" : "none"})
        $(".success").css({"display" : "none"})
    }

    function reset() {
        $("#pqr_type").val("")
        $("#issue").val("")
        $("#pqr_user").val("")
        $(".actions-block").css({"display" : "block"})
    }

})