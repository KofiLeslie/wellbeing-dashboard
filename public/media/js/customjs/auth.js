function statusAlert(res) {
    switch (res.code) {
        case 200:
            Swal.fire("Success!", res.message, "success");
            window.location.href = "/home";
            break;
        case 210:
            var stmt = "";
            try {
                var jsonString = JSON.stringify(res.error);
                var jsonSize = jsonString.length;
                if (jsonSize > 0) {
                    stmt = "<ul>";
                    $.each(res.error, function (key, value) {
                        stmt += "<li>" + key + ": " + value + "</li>";
                    });
                    stmt += "</ul>";
                }
            } catch (error) {}
            Swal.fire({
                title: "<strong>Ooops!</strong>",
                icon: "error",
                html: "<h5>" + res.message + "</h5> " + stmt,
            });
            break;
        default:
            Swal.fire("Oops!", res.message, "error");
            break;
    }
}
function register() {
    event.preventDefault();
    Swal.fire({
        title: "Do you want to save?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            const form = $("#myform")[0];
            let fd = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/api/users",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "json",
                cache: false,
                success: function (res) {
                    statusAlert(res);
                },
                error: function (res) {
                    var stmt = "";
                    try {
                        var jsonString = JSON.stringify(res.responseJSON.error);
                        var jsonSize = jsonString.length;
                        if (jsonSize > 0) {
                            stmt = "<ul>";
                            $.each(
                                res.responseJSON.error,
                                function (key, value) {
                                    stmt +=
                                        "<li>" + key + ": " + value + "</li>";
                                }
                            );
                            stmt += "</ul>";
                        }
                    } catch (error) {}
                    Swal.fire({
                        title: "<strong>Ooops!</strong>",
                        icon: "error",
                        html:
                            "<h5>" + res.responseJSON.message + "</h5> " + stmt,
                    });
                },
            });
        } else if (result.isDenied) {
            Swal.fire("Nothing saved", "", "info");
        }
    });
}

function login() {
    event.preventDefault();
    const form = $("#myform")[0];
    let fd = new FormData(form);
    $.ajax({
        type: "POST",
        url: "/api/users/login",
        data: fd,
        contentType: false,
        processData: false,
        dataType: "json",
        cache: false,
        success: function (res) {
            statusAlert(res);
        },
        error: function (res) {
            var stmt = "";
            try {
                var jsonString = JSON.stringify(res.responseJSON.error);
                var jsonSize = jsonString.length;
                if (jsonSize > 0) {
                    stmt = "<ul>";
                    $.each(res.responseJSON.error, function (key, value) {
                        stmt += "<li>" + key + ": " + value + "</li>";
                    });
                    stmt += "</ul>";
                }
            } catch (error) {}
            Swal.fire({
                title: "<strong>Ooops!</strong>",
                icon: "error",
                html: "<h5>" + res.responseJSON.message + "</h5> " + stmt,
            });
        },
    });
}
