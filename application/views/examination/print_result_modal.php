    <div class="col-lg-12">
        <div class="card">
                <a href="<?php echo base_url('examination/print_result/' . $this->uri->segment(3)) ?>">
                <button class="btn btn-info btn-block">Print All</button> <br/></a>
                    <form id="print-result">
                           <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">School</label>
                                </div>
                                <select name="school" class="custom-select" id="school">
                                    <option value="" selected>Choose...</option>
                                    <option value="1">Boarding</option>
                                    <option value="2">Day</option>
                                </select>
                            </div>
                            <input type="text" id="assessment_id" hidden="" name="assessment_id" value="<?php echo $this->uri->segment(3); ?>">
                            <input type="text" id="class_id" hidden="" name="class_id" value="<?php echo $this->uri->segment(4); ?>">
                           <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Class Arm</label>
                                </div>
                                <select name="arm" id="arm" class="custom-select" id="inputGroupSelect01">
                                    <option value="" selected>Choose...</option>
                                    <?php foreach($arm_list as $arm) { ?>
                                    <option value="<?php echo $arm->id ?>"><?php echo $arm->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>


        </div>
    </div>