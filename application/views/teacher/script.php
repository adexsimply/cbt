
<script type="text/javascript">
    

      ////Function to show form for session editing
          function get_teacher_subjects(teacher_id) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('user/get_teacher_subjects')?>',
          dataType : 'json',
          data: {id: teacher_id},
          success: function(data){
            console.log(data.length);
                var html = '';
                var i;
                var sn = 1;
                for(i=0; i<data.length; i++){
                  // var amount_paid1 = data[i].amount_paid; 
                  // var payment_date1 = data[i].payment_date; 
                  // if(data[i].amount_paid == null){
                  //   amount_paid1 = "";
                  // }
                  // if(data[i].payment_date == null){
                  //   payment_date1 = "";
                  // }
                    html += '<tr>'+
                          '<td>'+sn+'</td>'+
                          '<td>'+data[i].subject_name+'</td>'+
                            '<td>'+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" onclick="delete_subject('+data[i].ts_id+')">Remove</a>'+
                                '</td>'+
                            '</tr>';

                          sn++;
                }
                $('#show_data').html(html);
          }
      });
          }

    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-teacher').disable([".action"]);
        $("button[title='add_teacher']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'user/validate_teacher_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-teacher').enable([".action"]);
        $("button[title='add_teacher']").html("Save changes");
        if (returnData != 'success') {
            $('#add-teacher').enable([".action"]);
            $("button[title='add_teacher']").html("Save changes");
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

    function save_teacher_name(formData) {
        $("button[title='add_teacher']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'user/add_teacher_name'; ?>", formData).done(function(data) {

            window.location = "<?php echo base_url().'user/teacher'; ?>";
        });
    }

    function form_routes_add(action) {
        if (action == 'add_teacher') {
            var formData = $('#add-teacher').serialize();
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
                    save_teacher_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends



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


        function delete_subject(id) {
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
            $.post("<?php echo base_url('user/delete_subject_for_teacher'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }


      ////Function to show form for session editing
          function get_teacher_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('user/get_teacher_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){
            console.log(data);
                  var first_name = data[0].first_name;
                  var last_name = data[0].last_name;
                  var phone = data[0].phone;
                  var email = data[0].email;

                  $('[name="first_name"]').val(first_name);
                  $('[name="last_name"]').val(last_name);
                  $('[name="phone"]').val(phone);
                  $('[name="email"]').val(email);
                  $('[name="teacher_id"]').val(idr);
                  $('#subject').hide();

          }
      });
          }


      ////Function to show form for session editing
          function change_password(idr) {
            $('[name="teacher_id"]').val(idr);
          }
      ////Send Password to controller
          function change_password2() {
            var teacher_id = document.getElementById("teacher_id").value;
            var password = document.getElementById("password").value;
            
           $.post("<?php echo base_url() . 'user/change_password'; ?>", {teacher_id : teacher_id,password : password}).done(function(data) {
          window.location = "<?php echo base_url().'user/teacher'; ?>";
          });
          //console.log(teacher_id+password);
          }
      ////Send Password to controller
          function send_password(id) {
            var username = document.getElementById("username2"+id).value;
            var password = document.getElementById("password2"+id).value;
            var phone = document.getElementById("phone2"+id).value;
            
           $.post("<?php echo base_url() . 'user/send_password'; ?>", {username: username,password : password,phone:phone}).done(function(data) {
          window.location = "<?php echo base_url().'user/teacher'; ?>";
          });
          //console.log(teacher_id+password);
          }

         ///This clears textbox on modal toggle
          function clear_textbox() {
            $('input[type=email]').val('');
            $('input[type=text]').each(function() {
                $(this).val('');
            });

                  $('#subject').show();
          }

          ////

          function get_teacher_id (id) {

           $('#teacher_id2').val(id);

          }

        function add_to_subject(subject_id) {
            var teacher_id = document.getElementById("teacher_id2").value;
          //console.log(studID);

            $.post("<?php echo base_url() . 'user/add_subject_to_teacher'; ?>", {teacher_id : teacher_id,subject_id : subject_id}).done(function(data) {
              
          window.location = "<?php echo base_url().'user/teacher'; ?>";
        })
          }

</script>