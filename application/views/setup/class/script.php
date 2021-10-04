
<script type="text/javascript">  
  
  $(function () {
    $('#example').DataTable();


});
    
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-class').disable([".action"]);
        $("button[title='add_class']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'setup/validate_class_name'; ?>", async: false, type: 'POST', data: formData,
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
        $.post("<?php echo base_url() . 'setup/add_class_name'; ?>", formData).done(function(data) {

            window.location = "<?php echo base_url().'setup/classed'; ?>";
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
    function sync_class_name() {
       // $("button[title='add_class']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'setup/add_class_name_system'; ?>").done(function(data) {

            window.location = "<?php echo base_url().'setup/classed'; ?>";
        });
    }

    //////////////Add session form ends



    function delete_class_name(rowIndex) {


          $.confirm({
            title: 'Delete Class?',
            content: 'Are you sure you want to perform this action?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Delete',
                    btnClass: 'btn-red',
                    action: function(){
                          $.post("<?php echo base_url() . 'setup/delete_class'; ?>", {id : rowIndex}).done(function(data) {
                           window.location = "<?php echo base_url().'setup/classed'; ?>";
                      });
                    }
                },
                close: function () {
                }
            }
        });

    }

      ////Function to show form for session editing
          function get_class_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('setup/get_class_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){

                  var class_name = data[0].class_name;
                  var class_group_id = data[0].class_group_id;
                  var class_school = data[0].class_school;

                  var class_id = data[0].id;
                  $('[name="class_name"]').val(class_name);
                  $('[name="school"]').val(class_school);
                  $('[name="group"]').val(class_group_id);
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