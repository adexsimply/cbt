<!doctype html>
<html lang="en">

<head>
<title>CSMT - CBT :: Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/color_skins.css">
</head>

<body class="theme-cyan">
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <h1 style="color: #000000;">CSMT || CBT</h1>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="lead">Login to your account</p>

                            <div style="display: none" class="validation-message alert alert-danger" role="alert" data-field="password"> </div>
                        </div>
                        <div class="body">
                            <form id="form-signin">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" value="CSMT/SSS/15/184" placeholder="Email" name="username">
                                    <input type="text" hidden="" value="student" class="form-control" name="student">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" value="6811" placeholder="Password" name="password">
                                </div>
                            <!--     <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>                                
                                </div> -->
                                <button id="sign-in" type="button" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                <div class="bottom">
                                    <!-- <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span> -->
                                    <span>Don't have an account? <a href="<?php echo base_url() ?>auth/signup">Register</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>
</html>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    ////Signin script starts here       
    $('#sign-in').on("click", function() {
        login();
    });
    $("#form-signin").keypress(function(event) {
        if (event.which == 13) {
            login();
        }
    });

    function login() {
        $('#sign-in').html("Authenticating...").attr('disabled', true);
        var data = $('#form-signin').serialize();
        $.post("<?php echo base_url() . 'auth/login_attempt'; ?>", data).done(function(data) {
            console.log(data)
            if (data.status == "success") {
                window.location.replace("<?php echo base_url(); ?>");
            } else {

                $('#sign-in').html("Login").attr('disabled', false);
                $('.validation-message').show('');
                $('.validation-message').html('');
                $('.validation-message').each(function() {
                    for (var key in data) {
                        if ($(this).attr('data-field') == key) {
                            $(this).html(data[key]);
                        }
                    }
                });
            }
        });
    }
    /////////////End of Signin script
</script>