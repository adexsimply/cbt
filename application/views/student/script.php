
<script type="text/javascript">
      ////Send Password to controller
          function send_text_to_all() {
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
            
           $.post("<?php echo base_url() . 'user/send_password_to_all'; ?>", {}).done(function(data) {
          window.location = "<?php echo base_url().'user/student'; ?>";
          });
         })
          //console.log(teacher_id+password);
          }
    
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-student').disable([".action"]);
        $("button[title='add_student']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'user/validate_student_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-student').enable([".action"]);
        $("button[title='add_student']").html("Save changes");
        if (returnData != 'success') {
            $('#add-student').enable([".action"]);
            $("button[title='add_student']").html("Save changes");
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

    function save_student_name(formData) {
        $("button[title='add_student']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'user/add_student_name'; ?>", formData).done(function(data) {

            window.location = "<?php echo base_url().'user/student'; ?>";
        });
    }

    function form_routes_add(action) {
        if (action == 'add_student') {
            var formData = $('#add-student').serialize();
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
                    save_student_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends



    function delete_student_name(rowIndex) {
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
          function get_student_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('user/get_student_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){
            console.log(data);
                  var class_name = data[0].class;
                  var phone = data[0].phone;
                  var csmt_id = data[0].csmt_id;
                  var fullname= data[0].fullname;

                  $('[name="class"]').val(class_name);
                  $('[name="phone"]').val(phone);
                  $('[name="csmt_id"]').val(csmt_id);
                  $('[name="fullname"]').val(fullname);
                  $('[name="student_id"]').val(idr);
          }
      });
          }


      ////Function to show form for session editing
          function get_student_data5(redio) {
         var data;
                     $.ajax({
                          type: "POST",
                          url: '<?php echo base_url().'user/get_student_details3'; ?>',
                          dataType : 'json',
                          data: {student_id: redio},
                          success: function(data){
                           //console.log(data);
                           //return data;
                          }
          });

                           return data;
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

      ////Function to show form for session editing
          function add_class(student_id) {
            $('[name="student_id"]').val(student_id);
              $('[name="class"]').val('');
            $.ajax({
          type: "POST",
          url: '<?php echo base_url().'user/get_student_class_by_id'; ?>',
          dataType : 'json',
          data: {id: student_id},
          success: function(data){
            console.log(data);
            if (data !== null) {

                  $('[name="class"]').val(data[0].class_arm_id);
            }
            else {
              $('[name="class"]').val();
            }

          }
      });
          }

      ////Function to show form for session editing
          function add_class_to_student(student_id) {
            var student_id = document.getElementById("student_id").value;
            var class_arm_id = document.getElementById("class_arm_id").value;

            $.post('<?php echo base_url().'user/add_class_to_student'; ?>', {student_id : student_id,class_arm_id : class_arm_id}).done(function(data) {
             location.reload();
            });
          }

$(document).ready(function () {
listEmployee(); 
  var table = $('#employeeListing').dataTable({     
    "bPaginate": true,
    "bInfo": true,
    "bFilter": true,
    "bLengthChange": true,
    "pageLength": 10   
  }); 


  // list all employee in datatable
  function listEmployee(){
    $.ajax({
      type  : 'ajax',
      url   : '<?php echo base_url('user/get_student_details4');?>',
      async : false,
      dataType : 'json',
      success : function(response){
        //console.log(response);
        var html = '';
        var i;
        for(i=1; i<response.length; i++){
          
               if (response[i].class_group_id==1) {
                                   var class_group = "CSMT";
                                  }
                                  else {
                                    var class_group = "Others";
                                  }
               if (response[i].school_type==1) {
                                   var school_type = "Boarding";
                                  }
                                  else if (response[i].school_type==2) {
                                   var school_type = "Day";
                                  }
                                  else {
                                   var school_type = " - ";

                                  }
               if (response[i].password === null) {
                                   var password = " - ";
                                  }
                                  else {
                                   var password = response[i].password;

                                  }

          html += '<tr><td>'+i+'</td> <td>'+response[i].fullname+'</td><td>'+class_group+'</td> <td>'+response[i].class_name+'</td> <td>'+response[i].alias_name+'</td> <td>'+school_type+'</td> <td>'+response[i].username+'</td><td>'+response[i].password+'</td> <td><button type="button" class="btn btn-info btn-xs" onclick="get_student_data('+response[i].user_id+')" data-toggle="modal"  data-target="#modal-student"><i class="fa fa-edit"></i></button> <button type="button" class="btn btn-default btn-xs" onclick="delete_user('+response[i].user_id+','+response[i].role_id+')"><i class="fa fa-trash"></i></button> <button type="button" class="btn btn-primary btn-xs" onclick="change_password('+response[i].user_id+')" data-toggle="modal" data-target="#modal-password"><i class="fa fa-lock"></i> Edit Password</button>   <input type="text" value="'+password+'" hidden id="password2'+response[i].user_id+'" name="password2"><input type="text" value="'+response[i].phone+'" hidden id="phone2'+response[i].user_id+'" name="phone2"> <input type="text" value="'+response[i].username+'" hidden id="username2'+response[i].user_id+'" name="username2"> </td> </tr>';
        }
        $('#listRecords').html(html);         
      }

    });
  }
});

    function sync_students() {
       // $("button[title='add_class']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'user/add_student_name_system'; ?>").done(function(data) {
          //console.log(data);
           location.reload();
        });
    }

</script>