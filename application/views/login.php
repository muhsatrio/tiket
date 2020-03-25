<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login/style.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <center>
            <h1>Login</h1>
        </center>
        <div class="row">
            <div class="login-box">
                <div class="form-group">
                    <label for="email">Username:</label>
                    <input type="text" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let BASE_URL = "<?php echo base_url();?>index.php";
            $("#submit").click(function () { 
                let username = $("#username").val();
                let password = $("#password").val();
                // $.get("/ticket/login/proccess", {
                //     username,
                //     password
                // },
                // function (data) {
                //     console.log(data);
                // });
                $.post(BASE_URL + "/login/proccess", {
                    username,
                    password
                },
                function (data) {
                    // console.log(data.status);
                    if (data.status==200) {
                        alert('Login berhasil');
                        location.href = BASE_URL;
                    }
                    else {
                        alert('Username atau password salah, silahkan login kembali.');
                    }
                });
            });
        });
    </script>
</body>
</html>