<!DOCTYPE html>
<html>
<head>
<title>CSMT</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<!-- Meta tag Keywords -->
<link href="<?php echo base_url(); ?>assets/css/old/style.css" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-css-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/old/font-awesome.css"><!--fontawesome-->

</head>
<body>
    
	<div class="w3ls-main">
		<div class="wthree-heading"><p>&nbsp;</p>
            
			<h1 style="font-size:25px; font-weight:bold; color:#6B3F96">  <br>CSMT SCHOOLS<br>CBT EXAM PORTAL</h1>
		</div>
			<div class="wthree-container">
				<div class="wthree-form">
					<div class="agileits-2">
						<h2>login<br>
                        <span style="font-size:14px; text-transform:lowercase;">
                            <div style="display: none" class="validation-message alert alert-danger" role="alert" data-field="password"> </div></span>
                        </h2>
                        
					</div>                    
					<form id="form-signin">
						<div class="w3-user">
							<span><i class="fa fa-user-o" aria-hidden="true"></i></span>
							<input type="text" name="username" placeholder="Registration Number" required="">
                                    <input type="text" hidden="" value="student" class="form-control" name="student">
						</div>
						<div class="clear"></div>
						<div class="w3-psw">
							<span><i class="fa fa-key" aria-hidden="true"></i></span>
							<input type="password" name="password" placeholder="Password" required="">
						</div>
						<div class="clear"></div>
						<div class="w3l">
							<span><a href="<?php echo base_url('auth/register') ?>" style="color:#FFBF00;">Create new account.</a></span>  
						</div>
						<div class="clear"></div>
						<div class="w3l-submit">
                                <button id="sign-in" type="button" class="submit-button">LOGIN</button>
								<!-- <input type="submit" value="login"> -->
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
	</div>
		<div class="agileits-footer">
			<p style="color:#000;">&copy; CSMT</p>
		</div>
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
          //  console.log(data)
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