
<script type="text/javascript">
    
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-session').disable([".action"]);
        $("button[title='add_session']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'setup/validate_session_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-session').enable([".action"]);
        $("button[title='add_session']").html("Save changes");
        if (returnData != 'success') {
            $('#add-session').enable([".action"]);
            $("button[title='add_session']").html("Save changes");
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

    function save_session_name(formData) {
        $("button[title='add_session']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'setup/add_session_name'; ?>", formData).done(function(data) {

            window.location = "<?php echo base_url().'setup/session'; ?>";
        });
    }

    function form_routes_add(action) {
        if (action == 'add_session') {
            var formData = $('#add-session').serialize();
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
                    save_session_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends



    function delete_session_name(rowIndex) {
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
        $.post("<?php echo base_url() . 'setup/delete_sess'; ?>", {id : rowIndex}).done(function(data) {
         window.location = "<?php echo base_url().'setup/session'; ?>";
        });
      });
    }

    function activate_session_name(rowIndex) {
      swal({   
        title: "Are you sure want to Activate?",   
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }) .then(function() {
        //var row = datagrid.getRowData(rowIndex);
        $.post("<?php echo base_url() . 'setup/activate_sess'; ?>", {id : rowIndex}).done(function(data) {
         window.location = "<?php echo base_url().'setup/session'; ?>";
        });
      });
    }

      ////Function to show form for session editing
          function get_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('setup/get_session_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){

                  var sess1_name = data[0].session_title;
                  var sess_id = data[0].id;
                  var edit = "Edit"
                  $('[name="sess_name"]').val(sess1_name);
                  $('[name="sess_id"]').val(sess_id);
                  //document.getElementById('session_heading').innerHTML = "Edit Session";
          }
      });
          }

         ///This clears textbox on modal toggle
          function clear_textbox() {
            $('input[type=text]').each(function() {
                $(this).val('');
            });
          }

</script>