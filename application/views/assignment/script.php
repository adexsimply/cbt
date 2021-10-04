<script type="text/javascript">
	
    function delete_assignment(rowIndex) {
      swal({   
        title: "Are you sure want to delete this Assignment?",   
        text: "Deleted data can not be restored!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }) .then(function (){
        //var row = datagrid.getRowData(rowIndex);
        $.post("<?php echo base_url() . 'assignment/delete_assignment'; ?>", {id : rowIndex}).done(function(data) {
             location.reload();
        });
      });
    }
  
    function archive_assignment(rowIndex) {
      swal({   
        title: "Are you sure want to Archive this Assignment?",   
        text: "Deleted data can not be restored!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }) .then(function (){
        //var row = datagrid.getRowData(rowIndex);
        $.post("<?php echo base_url() . 'assignment/archive_assignment'; ?>", {id : rowIndex}).done(function(data) {
             location.reload();
        });
      });
    }

    function filter_by_class () {
      var class_id = document.getElementById('class').value;
      window.location = "<?php if(empty($this->uri->segment(3))) { $uri = "class"; } else { $uri = $this->uri->segment(3) ;} echo base_url().'assignment/view/'.$uri.'/'; ?>"+class_id
      console.log(class_id);
    }

    function view_grades () {
      var class_id = document.getElementById('class').value;
      var subject_id = document.getElementById('subject').value;
      window.location = "<?php echo base_url().'assignment/view_grade/'; ?>"+class_id+"/"+subject_id;


    }


</script>