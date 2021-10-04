<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Info 
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Notification</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">      

      <div class="row">     

        <div class="col-lg-12 col-12">  
        <?php if ($active_user->role_id==1) { ?>     
          <button class="btn btn-social btn-instagram mb-5 pull-right" data-toggle="modal" data-target="#modal-center" onclick="clear_textbox()">
            <i class="fa fa-plus"></i> Add Info
          </button>
        <?php } ?>
          <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body">
              <?php foreach($notices as $notice) {
                if ($notice->priority==1) {
                  $priority = "callout-secondary";
                }
                elseif ($notice->priority==2) {
                  $priority = "callout-primary";
                }
                elseif ($notice->priority==3) {
                  $priority = "callout-danger";
                }

               ?>
              <div class="callout <?php echo $priority; ?>">
        <?php if ($active_user->role_id==1) { ?> 
                <button type="button" class="close" onclick="delete_notice(<?php echo $notice->id; ?>)">&times;</button>
              <?php } ?>
                <h4><?php $ini_date = date_create($notice->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></h4>

                <p><?php echo $notice->body; ?></p>
                <h6 style="font-size: 12px;">Class: <?php if($notice->class_id==0) { echo "General"; } else { echo $notice->class_name; } ?> </h6>
                <?php 
                if ((($notice->attachment)!=NULL) AND (($notice->attachment)!='0')) { 
                    $imgagepath = explode("uploads/", $notice->attachment);
                    // echo $imgagepath[1];
                    $path = $notice->attachment;
                    $path2= base_url()."uploads/".$imgagepath[1];
                    echo "<p>Attachment: <a href='$path2' style='color:red;'>View File</a> </p>";
                } ?>
              </div>
            <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('notice/modal'); ?>
<?php $this->load->view('includes/footer'); ?>
  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('notice/script'); ?>