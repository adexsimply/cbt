
<script type="text/javascript">
  $(function () {
    $('#usersTable').DataTable();


});
    

      ////Function to show form for session editing
          function get_student_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('user/get_student_detailwwws')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){
            console.log(data);
                  var class_name = data[0].class_name;
                  var class_id = data[0].id;
                  $('[name="class_name"]').val(class_name);
                  $('[name="class_id"]').val(class_id);
          }
      });
          }

    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-user').disable([".action"]);
        $("button[title='add_user']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'user/validate_user_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-user').enable([".action"]);
        $("button[title='add_user']").html("Save changes");
        if (returnData != 'success') {
            $('#add-user').enable([".action"]);
            $("button[title='add_user']").html("Save changes");
            $('.form-control-feedback').html('');
            $('.form-control-feedback').each(function() {
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

    function save_user_name(formData) {
        $("button[title='add_user']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'user/add_user_name'; ?>", formData).done(function(data) {

            window.location = "<?php echo base_url().'user'; ?>";
        });
    }

    function form_routes_add(action) {
        if (action == 'add_user') {
            var formData = $('#add-user').serialize();
            if (validate(formData) == 'success') {
                swal({   
                    title: "Please check your data",   
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Save",
                    closeOnConfirm: true 
                }) .then(function() {
                    save_user_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends



    function delete_user_name(rowIndex) {
      swal({   
        title: "Are you sure want to delete this data?",   
        text: "Deleted data can not be restored!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }) .then(function (){
        //var row = datagrid.getRowData(rowIndex);
        $.post("<?php echo base_url() . 'user/delete_student'; ?>", {id : rowIndex}).done(function(data) {
         window.location = "<?php echo base_url().'setup/student'; ?>";
        });
      });
    }
      ////Function to show form for session editing
          function change_password(idr) {
            $('[name="student_id"]').val(idr);
          }
      ////Send Password to controller
          function change_password2() {
            var teacher_id = document.getElementById("teacher_id").value;
            var password = document.getElementById("password").value;
            
           $.post("<?php echo base_url() . 'user/change_password'; ?>", {teacher_id : teacher_id,password : password}).done(function(data) {
          window.location = "<?php echo base_url().'user/student'; ?>";
          });
          //console.log(teacher_id+password);
          }
      ////Send Password to controller
          function send_password(id) {
            var username = document.getElementById("username2"+id).value;
            var password = document.getElementById("password2"+id).value;
            var phone = document.getElementById("phone2"+id).value;
            
           $.post("<?php echo base_url() . 'user/send_password'; ?>", {username: username,password : password,phone:phone}).done(function(data) {
          window.location = "<?php echo base_url().'user/student'; ?>";
          });
          //console.log(teacher_id+password);
          }

         ///This clears textbox on modal toggle
          function clear_textbox() {
            $('input[type=text]').each(function() {
                $(this).val('');
            });
          }

        function delete_user(rowIndex,role_id) {
          if (role_id==1) {
          url = '<?php echo base_url().'user/delete_admin'; ?>';
          }
          else if (role_id==2) {
          url = '<?php echo base_url().'user/delete_teacher'; ?>';
          }
          else if (role_id==3) {
          url = '<?php echo base_url().'user/delete_student'; ?>';
          }
          swal({   
            title: "Are you sure want to delete this data?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post(url, {id : rowIndex,role : role_id}).done(function(data) {
             location.reload();
            });
          });
        }

</script>