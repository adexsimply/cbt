<script type="text/javascript">
  $(function () {
    $('#takenAssessmentTable').DataTable( {
  "ordering": false
} );

    $('#pendingAssessmentTable').DataTable( {
  "ordering": false,
  "paging" : false

} );


});

	function toggle_status(id) {
		var status;
		 if (document.getElementById("switch1"+id).checked === true) {
		 	status =1;
		 	//alert('ischecked');
		 }
		 else {
		 	status =0;
		 }

            $.ajax({
                url : "<?php echo base_url().'examination/toggle_status' ?>",
                dataType : 'json',
                type : 'POST',
                data : {status:status,id:id},
                success: function(resp) {
                    if (resp==true) {
                    	$.alert({
								    title: 'Done',
    								icon: 'fa fa-spinner fa-spin',
                                    type: 'green',
                                    content: '',
								    autoClose: 'cancelAction|0',    
								    buttons: {

							        cancelAction: {
							        	text: 'Close',
							            action: function () {
							           // $.alert('action is canceled');
							        }

							        }
								}
							}

                    		)
                    }
                }
            });
	}


	function toggle_autograde(id) {
		var status;
		 if (document.getElementById("switch2"+id).checked === true) {
		 	status =1;
		 	//alert('ischecked');
		 }
		 else {
		 	status =0;
		 }

            $.ajax({
                url : "<?php echo base_url().'examination/toggle_autograde' ?>",
                dataType : 'json',
                type : 'POST',
                data : {status:status,id:id},
                success: function(resp) {
                    if (resp==true) {
                    	$.alert({
								    title: 'Done',
    								icon: 'fa fa-spinner fa-spin',
                                    type: 'green',
                                    content: '',
								    autoClose: 'cancelAction|0',    
								    buttons: {

							        cancelAction: {
							        	text: 'Close',
							            action: function () {
							           // $.alert('action is canceled');
							        }

							        }
								}
							}

                    		)
                    }
                }
            });
	}
	function toggle_shuffle(id) {
		var status;
		 if (document.getElementById("switch3"+id).checked === true) {
		 	status =1;
		 	//alert('ischecked');
		 }
		 else {
		 	status =0;
		 }

            $.ajax({
                url : "<?php echo base_url().'examination/toggle_shuffle' ?>",
                dataType : 'json',
                type : 'POST',
                data : {status:status,id:id},
                success: function(resp) {
                    if (resp==true) {
                    	$.alert({
								    title: 'Done',
    								icon: 'fa fa-spinner fa-spin',
                                    type: 'green',
                                    content: '',
								    autoClose: 'cancelAction|0',    
								    buttons: {

							        cancelAction: {
							        	text: 'Close',
							            action: function () {
							           // $.alert('action is canceled');
							        }

							        }
								}
							}

                    		)
                    }
                }
            });
	}

  function toggle_result_view(id,status_d) {
    if(status_d==0){
    var status =1;
      //alert('ischecked');
     }
     else {
     var status =0;
     }
            $.ajax({
                url : "<?php echo base_url().'examination/toggle_result_view' ?>",
                dataType : 'json',
                type : 'POST',
                data : {status:status,id:id},
                success: function(resp) {
                  console.log(resp)
                    if (resp==true) {
                      $.alert({
                    title: 'Done',
                    icon: 'fa fa-spinner fa-spin',
                                    type: 'green',
                                    content: '',
                    autoClose: 'cancelAction|0',    
                    buttons: {

                      cancelAction: {
                        text: 'Close',
                          action: function () {

                      location.reload();
                         // $.alert('action is canceled');
                      }

                      }
                }
              })
                    }
                }
            });
  }

//////
	function taken(id) {
		var status = 3;

      /////////Dialog to confirm or cancel action

                                $.confirm({
                                    title: 'Move Exam to Taken?',
                                    content: 'Are you sure you want to Move?',
                                    icon: 'fa fa-check-circle',
                                    type: 'orange',
                                    buttons: {
                                        yes: function() {

                                                  $.ajax({
                                                      url : "<?php echo base_url().'examination/taken' ?>",
                                                      dataType : 'json',
                                                      type : 'POST',
                                                      data : {status:status,id:id},
                                                      success: function(resp) {
                                                          if (resp==true) {
                                                            $.alert({
                                                          title: 'Done',
                                                          icon: 'fa fa-spinner fa-spin',
                                                                          type: 'green',
                                                                          content: '',
                                                          autoClose: 'cancelAction|0',    
                                                          buttons: {

                                                            cancelAction: {
                                                              text: 'Close',
                                                                action: function () {
                                                               // $.alert('action is canceled');
                                                            }

                                                            }
                                                      }
                                                    }

                                                              )
                                                          }
                                                      }
                                                  });
                                                  location.reload();
                                        },
                                        no: function() {

                                        }
                                    }
                                });
	}



//////
  function pending(id) {
    var status = 0;

      /////////Dialog to confirm or cancel action

                                $.confirm({
                                    title: 'Move Exam to Pending?',
                                    content: 'Are you sure you want to Move?',
                                    icon: 'fa fa-check-circle',
                                    type: 'blue',
                                    buttons: {
                                        yes: function() {

                                                  $.ajax({
                                                      url : "<?php echo base_url().'examination/taken' ?>",
                                                      dataType : 'json',
                                                      type : 'POST',
                                                      data : {status:status,id:id},
                                                      success: function(resp) {
                                                          if (resp==true) {
                                                            $.alert({
                                                          title: 'Done',
                                                          icon: 'fa fa-spinner fa-spin',
                                                                          type: 'green',
                                                                          content: '',
                                                          autoClose: 'cancelAction|0',    
                                                          buttons: {

                                                            cancelAction: {
                                                              text: 'Close',
                                                                action: function () {
                                                               // $.alert('action is canceled');
                                                            }

                                                            }
                                                      }
                                                    }

                                                              )
                                                          }
                                                      }
                                                  });
                                                  location.reload();
                                        },
                                        no: function() {

                                        }
                                    }
                                });
  }



        function delete_exam(id) {

          $.confirm({
            title: 'Delete Exam!',
            content: 'Are you sure you want to perform this action?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Delete',
                    btnClass: 'btn-red',
                    action: function(){
                      $.post("<?php echo base_url('examination/delete_exam'); ?>", {id : id}).done(function(data) {
                       location.reload();
                      });
                    }
                },
                close: function () {
                }
            }
        });
        }


        function retake_exam(id,student_id) {

          $.confirm({
            title: 'Retake Exam?',
            content: 'This will delete the student entry!',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Delete',
                    btnClass: 'btn-red',
                    action: function(){
                      $.post("<?php echo base_url('examination/delete_exam_for_student'); ?>", {id : id,student_id : student_id}).done(function(data) {
                       location.reload();
                      });
                    }
                },
                close: function () {
                }
            }
        });
        }


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



  //////
  function grade_students_dialog(event) {

    event.preventDefault();
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var size = element.data('size');

////
   var scheduleDialog = $.confirm({
        title: 'Prompt!',
        columnClass: size,
        containerFluid: true,
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

            // scheduleSubmit: {
            //     text: "Schedule",
            //     btnClass: "btn-success",
            //     action: function () {


            //     }
            // },
            Close: function () {
                //close
                //return false;
            },
        },

        onContentReady: function () {
            // bind to events
            var jc = this;
        }
    });

}

  //////
  function print_dialog(event) {

    event.preventDefault();
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var size = element.data('size');
    var class_id = element.data('class_id');


////
   var scheduleDialog = $.confirm({
        title: 'Prompt!',
        columnClass: size,
        containerFluid: true,
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

            Print: {
                text: "Print",
                btnClass: "btn-success",
                action: function () {
                  ///////
                  var url ="";
                  var arm = $('#arm').val();
                  var assessment_id = $('#assessment_id').val();
                  var class_id = $('#class_id').val();
                  var school = $('#school').val();
                  if (arm=='') {
                    url +="";
                  }
                  else {
                    url +="arm="+arm
                  }
                  if (school=='') {
                    url +="";
                  }
                  else {
                    url +="&school="+school
                  }
                  var goto= '<?php echo base_url('examination/print_result/'); ?>'+assessment_id+'/'+class_id+'?'+url;
                  window.location = goto;
                  console.log(goto);

                  return false;


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
        }
    });

}

  //////
  function remark_exam_dialog(event) {

    event.preventDefault();
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var size = element.data('size');

////
   var remarksDialog = $.confirm({
        title: 'Prompt!',
        columnClass: size,
        containerFluid: true,
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
                text: "Submit Mark",
                btnClass: "btn-info",
                action: function () {

                  var confirmsir = "No"

                                    ////Validate form fields
                                    var formData = $('#remark-scores').serialize();
                                    console.log(formData)

                                      $.confirm({
                                          title: 'Submit Mark',
                                          content: 'Are you sure you want to Proceed?',
                                          icon: 'fa fa-check-circle',
                                          type: 'purple',
                                          buttons: {
                                              yes: function() {

                                                $.post("<?php echo base_url() . 'examination/remark_scores'; ?>", formData).done(function(data) {
                                                  //console.log(data);
                                                remarksDialog.close();
                                                location.reload();

                                                });
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
</script>