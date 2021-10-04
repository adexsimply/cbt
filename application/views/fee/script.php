
<script type="text/javascript">
    
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-fee').disable([".action"]);
        $("button[title='add_fee']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'fee/validate_fee'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-fee').enable([".action"]);
        $("button[title='add_fee']").html("Save changes");
        if (returnData != 'success') {
            $('#add-fee').enable([".action"]);
            $("button[title='add_fee']").html("Save changes");
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

    function save_fee_name(formData) {
        $("button[title='add_fee']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'fee/add_fee_name'; ?>", formData).done(function(data) {

           location.reload();
        });
    }

    function form_routes_add(action) {
        if (action == 'add_fee') {
            var formData = $('#add-fee').serialize();
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
                    save_fee_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends

         ///This clears textbox on modal toggle
          function clear_textbox() {
            $('input[type=text]').each(function() {
                $(this).val('');
            });
          }

</script>