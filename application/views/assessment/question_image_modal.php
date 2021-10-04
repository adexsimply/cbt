<div class="col-12">
	<div class="card box-margin">
		<div class="card-body">
			<form id="add-patient" action="<?php echo base_url('assessment/upload_image'); ?>" method="post" enctype="multipart/form-data">
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12" style="border-right: 1px solid #ced4da;">
						<input type="text" name="question_id" hidden value="<?php echo $this->uri->segment(3); ?>">
						<input type='file' class="form-control" name="image" id="user_image" onchange="readURL(this);" />
						<img id="blah" src="<?php if(!empty($question_details->image)) { echo base_url().'uploads/'.$question_details->image; } ?>" alt="" class="mt-3" />

						<div class="d-flex justify-content-end">
							<input type="submit" title="add_patient" class="btn btn-primary px-4 m-2" value="Save Image">
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah').show();
				$('#results').hide();

				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
		// console.log($('#user_image').val());
	}

</script>