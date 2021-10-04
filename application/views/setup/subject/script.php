<script type="text/javascript">
  $(function () {
    $('#subjectsTable').DataTable();


  });
    
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-subject').disable([".action"]);
        $("button[title='add_subject']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'setup/validate_subject_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-subject').enable([".action"]);
        $("button[title='add_subject']").html("Save changes");
        if (returnData != 'success') {
            $('#add-subject').enable([".action"]);
            $("button[title='add_subject']").html("Save changes");
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

    function save_subject_name(formData) {
        $("button[title='add_subject']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'setup/add_subject_name'; ?>", formData).done(function(data) {

            window.location = "<?php echo base_url().'setup/subject'; ?>";
        });
    }

    function form_routes_add(action) {
        if (action == 'add_subject') {
            var formData = $('#add-subject').serialize();
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
                    save_subject_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends


    function sync_subject_name() {
       // $("button[title='add_class']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'setup/add_subject_name_system'; ?>").done(function(data) {

           location.reload();
        });
    }




    function delete_subject_name(rowIndex) {
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
        $.post("<?php echo base_url() . 'setup/delete_subject'; ?>", {id : rowIndex}).done(function(data) {
         window.location = "<?php echo base_url().'setup/subject'; ?>";
        });
      });
    }

      ////Function to show form for session editing
          function get_subject_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('setup/get_subject_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){

                  var class_name = data[0].class_name;
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
///Func
$(document).ready(function(){
  //if ($("#basic_checkbox_0").click()) {
    //$('input:checkbox').prop('checked', this.checked);  
    $('#basic_checkbox_0').on('click',function(){
        if(this.checked){
            $('.filled-in').each(function(){
                this.checked = true;
            });
        }else{
             $('.filled-in').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.filled-in').on('click',function(){
        if($('.checkbox:checked').length == $('.filled-in').length){
            $('#basic_checkbox_0').prop('checked',true);
        }else{
            $('#basic_checkbox_0').prop('checked',false);
        }
    });


 // }

})
</script>