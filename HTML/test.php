





<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script>

        $(function () {

            $('form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'post',
                    url: '../PHP/manageStudentsTest.php',
                    data: $('form').serialize(),
                    success: function(res) {
                        
                        lastel = document.getElementById("testID");
                        lastel.innerHTML = res;
                        console.log(res);
                    }

                });
            });

        });



    </script>
    </head>

    <body>
        <form>
            <input name="student_id">
            <button type="submit" name="save"> submit </button>
      </form>
      <p id="testID">After here </p>
</body>
</html>