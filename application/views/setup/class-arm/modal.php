
                                <!-- Sign In Modal -->
                                <div id="class-arm-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <div class="modal-body">
                                                <div class="text-center my-3">
                                                    <a href="<?php echo base_url(); ?>" class="text-success">
                                                        <img src="<?php echo base_url(); ?>assets/demo/logo-expand-dark.png" alt="">
                                                    </a>
                                                </div>
                                                <form id="add-<?php echo strtolower($title); ?>">
                                                    <div class="form-group mr-b-10">
                                                         <input type="text" class="form-control" hidden="" name="class_arm_id" placeholder=" Example 2014 / 2015">
                                                        <label for="class_name">Class Name</label>
                                                        <select class="form-control" name="class_name" id="class_name">
                                                            <option></option>
                                                            <?php foreach ($class_list as $class) { ?>
                                                            <option value="<?php echo $class->id ?>"><?php echo $class->class_list_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div style="color: #ff0000;" class="form-control-feedback" data-field="class_name"></div>
                                                         <input type="text" class="form-control" hidden="" name="class_arm_id" placeholder=" Example 2014 / 2015">
                                                        <label for="class_name">Arm Name</label>
                                                        <select class="form-control" name="arm_name" id="arm_name">
                                                            <option></option>
                                                            <?php foreach ($arm_list as $arm) { ?>
                                                            <option value="<?php echo $arm->id ?>"><?php echo $arm->arm_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div style="color: #ff0000;" class="form-control-feedback" data-field="arm_name"></div>
                                                        <label for="class_name">Alias</label>
                                                        <input class="form-control" type="text" name="alias" id="alias"required="" placeholder="Humanity">
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button class="btn btn-color-scheme ripple" type="button" title="add_class_arm" onclick="form_routes_add('add_class_arm')">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->