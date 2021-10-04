<script type="text/javascript">
  console.log(localStorage)



  $(function () {
    $('#assessmentTable').DataTable( {
  "ordering": false
} );

    $('#questionsListTable').DataTable( {
  "ordering": false,
  "paging" : false

} );


});



  //////
  function question_dialog(event) {

    event.preventDefault();
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');

////
   var questionDialog = $.confirm({
        title: 'Prompt!',
        columnClass:'col-md-12',
        content: function () {
                  var self = this;
                  return $.ajax({
                      url: url,
                      method: 'get',
                  }).done(function (data) {
                      self.setContent(data);
                      self.setTitle(title);
                  }).fail(function(){
                      self.setContent('Something went wrong');
                  });
              },
        buttons: {

            questionSubmit: {
                text: "Update Question",
                btnClass: "btn-dark",
                action: function () {

                  var confirmsir = "No"
                  


                          ////
                            var formData = $('#send-payment').serialize();
                            var amount = $("#main_amount").val()

                            this.buttons.questionSubmit.setText('Saving Question...');

                            var formData = $('#update-question-d').serialize();
                            console.log(formData);
                                $.confirm({
                                    title: 'Update Question',
                                    content: 'Are you sure you want Submit?',
                                    icon: 'fa fa-check-circle',
                                    type: 'orange',
                                    buttons: {
                                        yes: function() {
                                            $.post("<?php echo base_url() . 'assessment/update_question'; ?>", formData).done(function(data) {
                                              console.log(data);
                                            });
                                            ///Close Big Dialog
                                            questionDialog.close();
                                            ///Refresh Prescription Table
                                            window.location = "<?php echo base_url().'assessment/view_questions/'.$this->uri->segment(3); ?>";
                                        },
                                        no: function() {

                                        }
                                    }
                                });

                        //console.log(confirmsir);
                  if (confirmsir=='No') {
                    return false;
                  }
                  else {
                    return true;
                  }


                }
            },
            Close: function () {
                //close
                //return false;
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {

                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

}


  //////
  function image_dialog(event) {

    event.preventDefault();
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');

////
   var imageDialog = $.confirm({
        title: 'Prompt!',
        columnClass:'col-md-12',
        content: function () {
                  var self = this;
                  return $.ajax({
                      url: url,
                      method: 'get',
                  }).done(function (data) {
                      self.setContent(data);
                      self.setTitle(title);
                  }).fail(function(){
                      self.setContent('Something went wrong');
                  });
              },
        buttons: {

            Close: function () {
                //close
                //return false;
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {


       // $("#add-patient").submit(function(e){
            e.preventDefault();
            var formData = new FormData($("#add-patient")[0]);

            $.ajax({
                url : $("#add-patient").attr('action'),
                dataType : 'json',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,
                success: function(resp) {
                    console.log(resp);
                    alert ('Image Uploaded')
                    $('.error').html('');
                    if(resp.status == false) {
                      $.each(resp.message,function(i,m){
                          $('.'+i).text(m);
                      });
                     }
                }
            });
      //  });
        imageDialog.close();



            });
        }
    });

}

///////

  //////
  function schedule_dialog(event) {

    event.preventDefault();
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var size = element.data('size');

////
   var scheduleDialog = $.confirm({
        title: 'Prompt!',
        columnClass: size,
        content: function () {
                  var self = this;
                  return $.ajax({
                      url: url,
                      method: 'get',
                  }).done(function (data) {
                      self.setContent(data);
                      self.setTitle(title);
                  }).fail(function(){
                      self.setContent('Something went wrong');
                  });
              },

        buttons: {

            scheduleSubmit: {
                text: "Schedule",
                btnClass: "btn-success",
                action: function () {

                  var confirmsir = "No"

                                    ////Validate form fields
                                    var formData = $('#schedule-exam').serialize();
                                      ///
                                      var returnData;
                                      ///
                                    validate(formData);

                                  function validate(formData) {
                                  
                                  $.ajax({
                                      url: "<?php echo base_url() . 'assessment/validate_schedule'; ?>",
                                      async: false,
                                      type: 'POST',
                                      data: formData,
                                      success: function(data, textStatus, jqXHR) {
                                          returnData = data;
                                      }
                                  });

                                    // $('#add-prescription').enable([".action"]);
                                    // $("button[title='add_prescription']").html("Save changes");
                                    if (returnData != 'success') {
                                        // $('#add-prescription').enable([".action"]);
                                        // $("button[title='add_prescription']").html("Save changes");
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
                                    //console.log(returnData);
                                }

                                if (returnData != 'success') {
                                      return false;
                                }
                                else {

                                      $.confirm({
                                          title: 'Schedule Exam',
                                          content: 'Are you sure you want to Proceed?',
                                          icon: 'fa fa-check-circle',
                                          type: 'blue',
                                          buttons: {
                                              yes: function() {

                                                $.post("<?php echo base_url() . 'assessment/save_schedule'; ?>", formData).done(function(data) {
                                                  scheduleDialog.close();

                                                  window.location = "<?php echo base_url('examination'); ?>";

                                                });
                                              },
                                              no: function() {

                                              }
                                          }
                                      });

                                }



                                      
                        //console.log(confirmsir);
                  if (confirmsir=='No') {
                    return false;
                  }
                  else {
                    return true;
                  }


                }
            },
            Close: function () {
                //close
                //return false;
            },
        },

        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {


       // $("#add-patient").submit(function(e){
            e.preventDefault();
            var formData = new FormData($("#add-patient")[0]);

            $.ajax({
                url : $("#add-patient").attr('action'),
                dataType : 'json',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,
                success: function(resp) {
                    console.log(resp);
                    alert ('Image Uploaded')
                    $('.error').html('');
                    if(resp.status == false) {
                      $.each(resp.message,function(i,m){
                          $('.'+i).text(m);
                      });
                     }
                }
            });
      //  });
        imageDialog.close();



            });
        }
    });

}

function start_exam(id) {

  ////Check if exam is done 

       $.ajax({
      type  : 'post',
      url   : '<?php echo base_url('assessment/check_if_exam_in_progress'); ?>',
      data: {
          //status: status,
          assessment_id: id,
        },
      async : false,
      dataType : 'json',
      success : function(response){
        //console.log(response);
        if (response =='') {
            $.confirm({
                    title: 'Start Exam',
                    content: 'Are you sure you want to Start Exam?',
                    icon: 'fa fa-check-circle',
                    type: 'green',
                    buttons: {
                        yes: function() {
                          ///update exam log
                             $.ajax({
                            type  : 'post',
                            url   : '<?php echo base_url('assessment/update_exam_log'); ?>',
                            data: {
                                //status: status,
                                assessment_id: id,
                              },
                            async : false,
                            success : function(response){} });


                          window.location = "<?php echo base_url().'assessment/view_questions'; ?>";

                        },
                        no: function() {

                        }
                    }
                });

        }
        else {
          alert('Exam in Progress')
        }

    }
  });
}
function continue_exam(id) {

            $.confirm({
                    title: 'Continue Exam',
                    content: 'If you proceed, exam will start Afresh!',
                    icon: 'fa fa-check-circle',
                    type: 'orange',
                    buttons: {
                        Proceed: function() {
                          ///update exam log
                          window.location = "<?php echo base_url().'assessment/view_questions'; ?>";

                        },
                        Cancel: function() {

                        }
                    }
                });
}
/////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-assessment').disable([".action"]);
        $("button[title='add_assessment']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'assessment/validate_assessment'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-assessment').enable([".action"]);
        $("button[title='add_assessment']").html("Save changes");
        if (returnData != 'success') {
            $('#add-assessment').enable([".action"]);
            $("button[title='add_assessment']").html("Save changes");
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

    function save_assessment(formData) {
        $("button[title='add_assessment']").html("Saving data, please wait...");
       // console.log(formData);
        $.post("<?php echo base_url() . 'assessment/add_assessment'; ?>", formData).done(function(data) {
          
         window.location = "<?php echo base_url().'assessment/view_questions/'; ?>"+data
           //console.log(data);

        });
    }

    function form_routes_add(action) {
        if (action == 'add_assessment') {
            var formData = $('#add-assessment').serialize();
            //console.log(formData);

                swal({   
                    title: "Are you sure you want to Submit?",   
                    text: "",
                    icon: "warning",
                    buttons: true,
                }) .then(function(isConfirm) {
                  if (isConfirm) {
                            
                    save_assessment(formData);
                                }else {
            //cancel();
        }
                });
        } else {
            cancel();
        }
    }

      ////Function to show form for session editing
          function add_question(id) {
          	var dodo = + new Date();
            $('#more_question').append('<div class="row" id="'+dodo +'"><div class=" col-12 mt-20"><input type="" value="1" name="food_id[]" hidden><label for="">Question</label><span class="text-danger">*</span><input type="text" id="question" name="question[]" class="form-control" required></div><div class="col-xl-12 col-md-12 col-12"><div class="form-group"><label>Instruction</label><span class="text-danger">*</span><textarea class="form-control" name="instruction[]"></textarea></div></div><div class="col-xl-12 col-md-12 col-12"><div class="form-group"><label>Comprehension</label><span class="text-danger">*</span><textarea class="form-control" name="comprehension[]"></textarea></div></div><div class="col-xl-6 col-md-6 col-12"><div class="form-group"><label>Option1</label><span class="text-danger">*</span><input type="text" id="option1" name="option1[]" class="form-control" required></div></div><div class="col-xl-6 col-md-6 col-12"><div class="form-group"><label>Option 2</label><span class="text-danger">*</span><input type="text" id="option2[]" name="option2[]" class="form-control" required></div></div><div class="col-xl-6 col-md-6 col-12"><div class="form-group"><label>Option3</label><span class="text-danger">*</span><input type="text" id="option3" name="option3[]" class="form-control" required></div></div><div class="col-xl-6 col-md-6 col-12"><div class="form-group"><label>Option 4</label><span class="text-danger">*</span><input type="text" id="option4" name="option4[]" class="form-control" required></div></div><div class="col-xl-6 col-md-6 col-12"><div class="form-group"><label>Correct Answer</label><span class="text-danger">*</span><select class="form-control" id="class" data-placeholder="Select a Class" name="answer[]" style="width: 100%;" required> <option value="">Select Option</option> <option value="1">A</option> <option value="2">B</option> <option value="3">C</option> <option value="4">D</option></select></div></div><div class="form-group"><i class="fa fa-remove color-danger" onclick="remove_question('+dodo+')" style="cursor: pointer;"></i></div></div></div>');
            //console.log(data);
          }

          function remove_question(fee_id) {
            $('#' + fee_id).remove();


          }


        function delete_assessment(id) {
          swal({   
            title: "Are you sure want to delete this Quiz?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('assessment/delete_assessment'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }


        function accept_assessment(id) {
          swal({   
            title: "Are you sure want to Accept this Quiz?",   
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('assessment/accept_assessment'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }
  
    function archive_assessment(rowIndex) {
      swal({   
        title: "Are you sure want to Archive this Quiz?",   
        text: "Deleted data can not be restored!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }) .then(function (){
        //var row = datagrid.getRowData(rowIndex);
        $.post("<?php echo base_url() . 'assessment/archive_assessment'; ?>", {id : rowIndex}).done(function(data) {
             location.reload();
        });
      });
    }



      ////Function to show form for session editing
          function get_question_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('assessment/get_question_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){
            console.log(data);
                  var question = data[0].question;
                  var option1 = data[0].option1;
                  var option2 = data[0].option2;
                  var option3 = data[0].option3;
                  var option4 = data[0].option4;
                  var answer = data[0].answer;

                  $('[name="question"]').val(question);
                  $('[name="option1"]').val(option1);
                  $('[name="option2"]').val(option2);
                  $('[name="option3"]').val(option3);
                  $('[name="option4"]').val(option4);
                  $('[name="answer"]').val(answer);
                  $('[name="question_id"]').val(idr);
          }
      });
          }




        function delete_question(id) {
          swal({   
            title: "Are you sure want to delete this Question?",   
            text: "Deleted questions can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('assessment/delete_question'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }


        function delete_question_main(id) {
          swal({   
            title: "Are you sure want to delete this Question?",   
            text: "Deleted questions can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('assessment/delete_question_main'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }


    function filter_by_class () {
      var class_id = document.getElementById('class').value;
      window.location = "<?php echo base_url().'assessment/class/'; ?>"+class_id
      console.log(class_id);
    }

</script>