
$(function () {

    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../PHP/manageStudentsFile.php',
            data: $('form').serialize(),
            success: function(res) {
                
                console.log(res);
            }

        });
    });

});