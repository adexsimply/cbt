<script type="text/javascript">
  

        function delete_notice(id) {
          swal({   
            title: "Are you sure want to delete this Notice?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('notice/delete_notice'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }

        function delete_comment(id) {
          swal({   
            title: "Are you sure want to delete this Comment?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('notice/delete_comment'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }
</script>