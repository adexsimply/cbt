<!-- <?php 

      $check_subscription = $this->db->select('*')->from('subscriptions')->where('user_id',$this->session->userdata('active_user')->id)->where('end_date >=', date('Y-m-d H:m:sa'))->get();
      if ($check_subscription->num_rows() > 0 ) {

        redirect(base_url());

      }
    
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>E-Learning - Confirm PIN</title>
  
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
    
    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-extend.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/master_style.css">
    <!-- Sweet Alert -->
    <link href="<?php echo base_url(); ?>assets/cdn/css/sweetalert2.css" rel="stylesheet" type="text/css">

    <!-- Qixa Admin skins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.css">   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page">
    <?php
     //var_dump($this->session->userdata('active_user'));
     ?>
    
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
           <div class="col-lg-4 col-md-8 col-12">
                <div class="login-box bg-img rounded" style="background-image:url(<?php echo base_url() ?>assets/images/gallery/landscape6.jpg);" data-overlay="5">
                  <div class="login-box-body pb-20">
                    <p class="login-box-msg text-uppercase">Enter Your PIN</p>

                    <form id="confirm-pin" class="form-element text-white">
                      <div class="form-group has-feedback">
                        <input type="number" name="pin" class="form-control text-white">
                      </div>      
                        <div class="form-control-feedback1" style="color: red" data-field="pin"></div>
                      <div class="row">
                        <div class="col-12 text-center">
                          <button type="button" title="confirm_pin" onclick="form_routes_cp('confirm_pin')" class="btn btn-info btn-block text-uppercase">Confirm</button>
                        </div>
                        <br>
                       <!--  <div class="col-12 text-center">
                          <button type="button" data-toggle="modal" data-target="#modal-classes" class="btn btn-success btn-block text-uppercase">Pay Here</button>
                        </div> -->
                      </div>
                    </form>

                  </div>
                </div>
            
            </div>
            <br>
        </div>
    </div>


    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/jquery-3.3.1/jquery-3.3.1.min.js"></script>
    
    <!-- popper -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/popper/dist/popper.min.js"></script>
    
    <!-- Bootstrap 4.0-->
    <script src="<?php echo base_url(); ?>assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/cdn/js/sweetalert2.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/disabler-enabler/enabler.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/assets/disabler-enabler/disabler.js" type="text/javascript"></script>

</body>
</html>
<?php $this->load->view('dashboard/modal-classes'); ?>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
        /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#confirm-pin').disable([".action"]);
        $("button[title='confirm_pin']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'auth/validate_entrance_pin'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#confirm-pin').enable([".action"]);
        $("button[title='confirm_pin']").html("Save changes");
        if (returnData != 'success') {
            $('#confirm-pin').enable([".action"]);
            $("button[title='confirm_pin']").html("Save changes");
            $('.form-control-feedback1').html('');
            $('.form-control-feedback1').each(function() {
                for (var key in returnData) {
                    if ($(this).attr('data-field') == key) {
                        $(this).html(returnData[key]);
                    }
                }
            });
        } else {
            return 'success';   
        }
    }

    function save_arm_name(formData) {
        $("button[title='confirm_pin']").html("Checking PIN, please wait...");
        $.post("<?php echo base_url() . 'auth/confirm_entrance_pin_name'; ?>", formData).done(function(data) {

          //console.log(data);
           window.location = "<?php echo base_url().'assessment/view'; ?>";
        });
    }

    function form_routes_cp(action) {
        if (action == 'confirm_pin') {
            var formData = $('#confirm-pin').serialize();
            if (validate(formData) == 'success') {
                    save_arm_name(formData);
        } else {
            cancel();
        }
    }
}
    //////////////Add session form ends



</script>