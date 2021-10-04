<script type="text/javascript">
  $(function () {
    $('#classArmsTable').DataTable();


});
    
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-class-arm').disable([".action"]);
        $("button[title='add_class_arm']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'setup/validate_class_arm_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-class-arm').enable([".action"]);
        $("button[title='add_class_arm']").html("Save changes");
        if (returnData != 'success') {
            $('#add-class-arm').enable([".action"]);
            $("button[title='add_class_arm']").html("Save changes");
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

    function save_class_arm_name(formData) {
        $("button[title='add_class_arm']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'setup/add_class_arm_name'; ?>", formData).done(function(data) {

            location.reload();
        });
    }

    function form_routes_add(action) {
        if (action == 'add_class_arm') {
            var formData = $('#add-class-arm').serialize();
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
                    save_class_arm_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends



    function delete_class_arm_name(rowIndex) {
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
        $.post("<?php echo base_url() . 'setup/delete_class_arm'; ?>", {id : rowIndex}).done(function(data) {
         window.location = "<?php echo base_url().'setup/class_arm'; ?>";
        });
      });
    }

      ////Function to show form for session editing
          function get_class_arm_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('setup/get_class_arm_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){

                  var class_name = data[0].class_name;
                  var class_id = data[0].class_id;
                  var arm_id = data[0].arm_id;
                  var arm_name = data[0].arm_name;
                  var alias = data[0].alias;
                  var class_arm_id = data[0].id;                  
                  $("#class_name").val(class_id);               
                  $("#arm_name").val(arm_id);
                  $('[name="alias"]').val(alias);
                  $('[name="class_arm_id"]').val(class_arm_id);
          }
      });
          }

         ///This clears textbox on modal toggle
          function clear_textbox() {
            $('input[type=text]').each(function() {
                $(this).val('');
            });
            $('select').each(function() {
                $(this).val('');
            });
          }

</script>