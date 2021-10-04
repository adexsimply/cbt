
<script type="text/javascript">
    
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-class').disable([".action"]);
        $("button[title='add_class']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'setup/validate_class_list_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-class').enable([".action"]);
        $("button[title='add_class']").html("Save changes");
        if (returnData != 'success') {
            $('#add-class').enable([".action"]);
            $("button[title='add_class']").html("Save changes");
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

    function save_class_name(formData) {
        $("button[title='add_class']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'setup/add_class_list_name'; ?>", formData).done(function(data) {
location.reload();
        });
    }

    function form_routes_add(action) {
        if (action == 'add_class') {
            var formData = $('#add-class').serialize();
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
                    save_class_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends



    function delete_class_name(rowIndex) {
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
        $.post("<?php echo base_url() . 'setup/delete_class_list'; ?>", {id : rowIndex}).done(function(data) {
         location.reload()
        });
      });
    }

      ////Function to show form for session editing
          function get_class_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('setup/get_class_list_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){

                  var class_name = data[0].class_list_name;
                  var class_id = data[0].id;
                  $('[name="class_name"]').val(class_name);
                  $('[name="class_id"]').val(class_id);
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