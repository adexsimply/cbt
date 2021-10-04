<script type="text/javascript">
listEmployee();
function get_student_id(id) {
	$('[name="student_id"]').val(id);
}
function create_subscription() {

      var end_date = document.getElementById('end_date').value;
      var user_id = document.getElementById('student_id').value;

      console.log(end_date);

          $.ajax({
          type: 'POST',
          url: '<?php echo base_url().'fee/create_subscription2'; ?>',
          data: {user_id:user_id, duration:end_date}, //How can I preview this?
          dataType: 'json',
          success: function(d){

             location.reload()
           //console.log(d);
           //alert(d.status); //will alert ok
          }
        });
	}


        function delete_sub(id) {
          swal({   
            title: "Are you sure want to delete this?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('subscription/delete_sub'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }

    function filter_by_class () {
      var class_id = document.getElementById('class').value;
      window.location = "<?php if(empty($this->uri->segment(3))) { $uri = "class"; } else { $uri = $this->uri->segment(3) ;} echo base_url().'subscription/view/class/'; ?>"+class_id
      console.log(class_id);
    }


     function listEmployee(date_time2){
                $.ajax({
                url: "<?php echo base_url('subscription/convert_date'); ?>",
                type: "get", //send it through get method
                data: { 
                  date_time: '2020-07-31 08:58:48', 
                },
                success: function(response2) {
                  return response2
                },
                error: function(xhr) {
                  console.log(xhr);
                  //Do Something to handle error
                }
              });

            }


$(document).ready(function () {
listStudentsSub(); 
  var table = $('#studentsListing').dataTable({     
    "bPaginate": true,
    "bInfo": true,
    "bFilter": true,
    "bLengthChange": true,
    "pageLength": 10   
  }); 


  // list all employee in datatable
  function listStudentsSub(){
    $.ajax({
      type  : 'ajax',
      url   : '<?php echo base_url('subscription/get_students_sub'); ?>',
      async : false,
      dataType : 'json',
      success : function(response){
        var html = '';
        var i;
        //console.log(response);
        for(i=1; i<response.length; i++){
          var sumn;
              // var red = listEmployee(response[i].end_date);
              // console.log(red);
              // var red;
              //   $.ajax({
              //   url: "<?php echo base_url('subscription/convert_date'); ?>",
              //   type: "get", //send it through get method
              //   data: { 
              //     date_time: response[i].end_date, } }).done(function(data1) {
              //       console.log(data1)
              //       return data1;
              //     });

          html += '<tr><td>'+i+'</td> <td>'+response[i].fullname+'</td> <td>'+response[i].phone+'</td><td>'+response[i].end_date+'</td><td>'+response[i].username+'</td>><td>'+response[i].password+'</td> <td> <button type="button" class="btn btn-info btn-xs" data-toggle="modal" onclick="get_student_id('+response[i].user_id+')"  data-target="#modal-duration"><i class="fa fa-edit"></i> Add Plan</button></td> </tr>';
        }
        $('#listStudents').html(html);         
      }

    });
  }
});
</script>