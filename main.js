$(document).ready(function () {

    $(window).on("load", GetInitialData);

    function GetInitialData() {

        $.ajax({
            type: "GET",
            url: "Ajax-Script.php",
            data: {
                test: 'test'
            },
            dataType: "json",
            async: false,
            success: function (data) {
                result = data;
                let i = 1;
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        $('#appended').append(
                            "<tr>" +
                                "<td>" + data[key].firstname + "</td>" +
                                "<td>" + data[key].lastname + "</td>" +
                                "<td>" + data[key].email + "</td>" +
                            "</tr>"
                        );
                    }
                }
            }
        });

        $.ajax({
            type: "GET",
            url: "Ajax-Script.php",
            data: {
                counted: 'counted'
            },
            dataType: "json",
            async: false,
            success: function (data) {
                let result = data[0]['COUNT(*)'];
                let size = result / 5;
                size = Math.round(size);
                for (i = 1; i <= size; i++) {
                    $('.pagination').append(
                        "<li>" + i + "</li>"
                    );
                }
            }
        });
    }

    $(document).on('click', 'li', function (e) {
        console.log(this.innerHTML);
        $.ajax({
            type: "GET",
            url: "Ajax-Script.php",
            data: {
                another: this.innerHTML
            },
            dataType: "json",
            async: false,
            success: function (data) {
                result = data;
                let i = 1;
                $('#appended tr').remove();
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        $('#appended').append(
                            "<tr>" +
                                "<td>" + data[key].firstname + "</td>" +
                                "<td>" + data[key].lastname + "</td>" +
                                "<td>" + data[key].email + "</td>" +
                            "</tr>"
                        );
                    }
                }
            }
        });
    });
});