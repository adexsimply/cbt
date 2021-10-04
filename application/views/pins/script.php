
<script type="text/javascript">

    function generate_pins_for_all() {
      swal({   
        title: "Are you sure want to generate PINS?",   
        text: "All Previous Pins Will Be Removed",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }) .then(function (){
        $("#preloader").show();
        $.post("<?php echo base_url() . 'pin/generate_all'; ?>", {}).done(function(data){

        $("#preloader").hide();
            swal("Done!", "Pin Generated Successfully.", "success"); 
         // console.log(data);
         location.reload();
        });
      });
    }

    function turn_pin_auth(id) {
         $.post("<?php echo base_url() . 'pin/turn_pin_auth'; ?>", {id:id}).done(function(data){

         location.reload();
        });
    }
    function generate_pin_for_one(student_id) {
      swal({   
        title: "Are you sure want to generate PIN ?",   
        text: "Previous Pin Will Be Removed",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }) .then(function (){
        $("#preloader").show();
        $.post("<?php echo base_url() . 'pin/generate_one'; ?>", {student_id:student_id}).done(function(data){

        $("#preloader").hide();
            swal("Done!", "Pin Generated Successfully.", "success"); 
         // console.log(data);
         location.reload();
        });
      });
    }

    function turn_pin_auth(id) {
         $.post("<?php echo base_url() . 'pin/turn_pin_auth'; ?>", {id:id}).done(function(data){

         location.reload();
        });
    }

      ////Send Password to controller
          function send_pin_to_all() {
          var student_count = document.getElementById("count_students").value;
          swal({   
            title: "Are you sure want to send text to all students? ?",   
            text: "There are "+student_count+" students. This might take a while",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }) .then(function (){
            
           $.post("<?php echo base_url() . 'pin/send_pin_to_all'; ?>", {}).done(function(data) {
          location.reload();
          });
         })
          //console.log(teacher_id+password);
          }

      ////Send Password to controller
          function send_pin(id) {
            var fullname = document.getElementById("fullname"+id).value;
            var password = document.getElementById("password2"+id).value;
            var phone = document.getElementById("phone2"+id).value;
            
           $.post("<?php echo base_url() . 'pin/send_pin'; ?>", {password : password,fullname : fullname,phone:phone}).done(function(data) {
           location.reload();
          });
          //console.log(teacher_id+password);
          }

function exempt_class(){
      var class_id = document.getElementById('class').value;
            $.post("<?php echo base_url('pin/exempt_class'); ?>", {id : class_id}).done(function(data) {
             location.reload();
            });
}

</script>

