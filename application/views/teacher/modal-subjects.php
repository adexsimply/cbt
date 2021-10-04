
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="modal-subject" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Subject List</h5>
                      <input type="text" id="teacher_id2" hidden="" name="">
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                    <div class="table-responsive">
                          <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Subject Name</th>
                              <th>Date Created</th>
                              <th>Options</th>
                            </tr>
                            <?php 
                                $i_class = 1;
                                foreach ($subject_list as $terms) { 
                                  //$term_status = $terms->term_status;
                                  ?>
                                <tr>
                                  <td><?php echo $i_class; ?></td>
                                  <td><?php echo $terms->subject_name; ?></td>
                                  <td><?php echo $terms->date_created; ?></td>
                              <td>
                              <button class="btn btn-social btn-vk mb-5" onclick="add_to_subject('<?php echo $terms->id;?>')" title="Delete"><i class="fa fa-plus"></i>  Add </button>
                             </td>
                            </tr>
                          <?php $i_class++;
                           } ?>
                            </table>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- /.modal -->
              
            </div>
          </div>
        </div>

  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>