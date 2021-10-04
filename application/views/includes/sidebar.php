<div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $active_user->username; ?></strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Change&nbsp;Password</a></li>
                        <li class="divider"></li>
                        <li><a <?php if($active_user->role_id==3) { ?> href="<?php echo base_url(); ?>auth/logout" <?php } else { ?> href="<?php echo base_url(); ?>auth/logout_admin"<?php } ?>><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
                <hr>
            </div>
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                            <li class="active"><a href="<?php echo base_url(); ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>
                            <?php if($active_user->role_id==1)  { ?>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-mortar-board"></i><span>Classes</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>setup/classed">All Classes</a></li>
                                    <li><a href="<?php echo base_url(); ?>setup/arm">Arms</a></li>
                                    <li><a href="<?php echo base_url(); ?>setup/class_arm">Class Arm</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-file-text-o"></i><span>Subjects</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>setup/subject">All Subjects</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-wallet"></i><span>Students</span> </a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>user/student">All Students</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-pencil"></i><span>Questions</span> </a>
                                <ul>

                                    <?php if($active_user->role_id!=3)  { ?>
                                    <li><a href="<?php echo base_url(); ?>assessment/questions">Manage Questions</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } 
                             ?>

                            <li <?php if ($menu_id =='Examination') { echo "class='active'";} ?>><a href="javascript:void(0);" class="has-arrow"><i class="icon-layers"></i><span>Examination</span> </a>
                                <ul>

                                    <?php if($active_user->role_id!=3)  { if ($active_user->role_id==1) { ?>
                                    <li><a href="<?php echo base_url(); ?>examination">Manage Pending Exams</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>examination/taken_exams">Manage Taken Exams</a></li>
                                    <?php } if($active_user->role_id==3)  { ?>
                                    <li><a href="<?php echo base_url(); ?>assessment/view">View Exams</a></li>
                                    <li><a href="<?php echo base_url(); ?>assessment/view_results">View Results</a></li>
                                    <!--     -->
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php if($active_user->role_id==1)  {?>
                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="icon-lock"></i><span>Users</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>user">All Users</a></li>
                                    <li><a href="<?php echo base_url(); ?>user/login_sessions23">Login Sessions</a></li>
                                    <li><a href="<?php echo base_url(); ?>user/exam_logs">Exam Logs</a></li>
                                    <li><a href="<?php echo base_url(); ?>user/active_exams">Active Exams (Students)</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        </ul>
                    </nav>
                </div>          
            </div>          
        </div>
    </div>
