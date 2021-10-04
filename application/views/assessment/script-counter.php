<script type="text/javascript">
  

  //////
  function expand_image_dialog(event) {

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


 function CountDown(duration, display) {

 //var duration = document.getElementById("duration").value;
 var full_url = document.getElementById("full_url").value;

                if (!isNaN(duration)) {
                    var timer = duration, minutes, seconds;


                if (localStorage.getItem(full_url)) {
                    if (localStorage.getItem(full_url) <= 0) {
                        var value = timer;
                        alert(value);
                    } else {
                        var timer = localStorage.getItem(full_url);
                    }
                } else {
                    var value = timer;
                }
                    
                  var interVal=  setInterval(function () {
                        minutes = parseInt(timer / 60, 10);
                        seconds = parseInt(timer % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        $(display).html("<b>" + minutes + "m : " + seconds + "s" + "</b>");
                        if (--timer < 0) {
                        localStorage.setItem(full_url, value);
                            timer = duration;
                           // $('form').submit();
                           SubmitFunction();
                           $('#display').empty();
                           clearInterval(interVal)
                        }
                        localStorage.setItem(full_url, timer);
                        },1000);
                }
            }
            
            function SubmitFunction(){
              localStorage.clear();
                var assessment_id = document.getElementById('exam_id').value;

                var exam_log_id = document.getElementById('exam_log_id').value;

                            ////////////

                             $.ajax({
                            type  : 'post',
                            url   : '<?php echo base_url('assessment/update_exam_log2'); ?>',
                            data: {
                                id: exam_log_id,
                                assessment_id: assessment_id,
                              },
                            async : false,
                            success : function(response){} });

               $('form').submit();
             //   document.getElementById("form").submit();
               // $('#submit').click();
            }
 //localStorage.clear();
 var duration = document.getElementById("duration").value;
        CountDown(duration *60,$('#display'));
        console.log(localStorage);
        //localStorage.clear();



        function disablebutton () { 
            // window.localStorage.clear()
            // localStorage.removeItem("full_url");
            $('#submited').html("Submitting Answer, please wait...");
            //$('#submited').prop('disabled', true); 
        }




</script>