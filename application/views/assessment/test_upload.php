<form action="<?php echo base_url('assessment/upload_image'); ?>" method="post" id="form_img" enctype="multipart/form-data" accept-charset="utf-8">
      
                        <input type="text" name="question_id" value="<?php echo $this->uri->segment(3); ?>">
        <div>
            file : <input type="file" name="image">
            <span class="error image"></span>
        </div>
        <input type="submit" name="submit" value="submit">
        </form>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#form_img").submit(function(e){
            e.preventDefault();
            var formData = new FormData($("#form_img")[0]);

            $.ajax({
                url : $("#form_img").attr('action'),
                dataType : 'json',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,
                success: function(resp) {
                    console.log(resp);
                    $('.error').html('');
                    if(resp.status == false) {
                      $.each(resp.message,function(i,m){
                          $('.'+i).text(m);
                      });
                     }
                }
            });
        });
    });

</script>