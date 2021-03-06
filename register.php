<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogbook</title>
    <script src="jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script>

        function checkUsernameField() {
            ok = 1;
            if($("#input_1").val().length == 0) {
                ok = 2;
            }

            $.ajax({
                url: 'checkUsernameAvailability.php',
                type: 'POST',
                async: false,
                data: {uem:$("#input_1").val()},
                success: function(response){
                    if(response == 1) {
                        ok = 3;
                    }
                }
            });

            return ok;
        }


        $(document).ready(function(){
            

            $.ajax({
                url: 'checkaccountlogin.php',
                type: 'POST',
                async: false,
                data: {uem:localStorage.blogbook_username, ups:localStorage.blogbook_password},
                success: function(response){
                    if(response == 1) {
                        window.location.replace("startusersession.php?uem="+localStorage.blogbook_username);
                    }
                }
            });

            
            $("#login_button").click(function(){
                if($("#input_1").val().length == 0) {
                    alert("You need a username");
                } else if($("#input_2").val().length < 8) {
                    alert("Your password has to be more than 8 characters long");
                } else if($("#input_2").val() != $("#input_3").val()) {
                    alert("Your passwords must match");
                } else {
                    if(checkUsernameField() != 1) {
                        alert("Username already taken");
                    } else {
                        $.ajax({
                            url: 'insertnewuseraccount.php',
                            type: 'POST',
                            data: {
                                rusername:$("#input_1").val(),
                                rpassword:$("#input_2").val()
                            },
                            success: function(response){
                                window.location.replace("login");
                            }
                        });
                    }
                }
            });

        });

    </script>
</head>
<body>

    <div id="login_left_panel">
        <img src="assets/logo_wide.png" id="login_logo">
        <div>
            <h4 class="form_title">Register</h4>
            <input type="text" placeholder="Username" id="input_1">
            <input type="password" placeholder="Password" id="input_2">
            <input type="password" placeholder="Confirm password" id="input_3">
            <p id="change_form_p">Already have an account? <a href="login">Login</a>.</p>
            <button id="login_button">Get started</button>
        </div>
        <p>© Copyright Blogbook 2020</p>
    </div>
    <div id="login_right_panel"></div>


    <script>
        function randomInt(min, max) {
            return min + Math.floor((max - min) * Math.random());
        }
        function getBgImg(){
            document.getElementById("login_right_panel").style.backgroundImage = "url('assets/LoginBg/"+randomInt(1, 9)+".jpg')";
        }
        getBgImg();
    </script>
</body>
</html>