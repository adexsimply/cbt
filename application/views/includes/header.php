<!-- Overlay For Sidebars -->
<div id="wrapper">
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>

            </div>

            <div class="navbar-brand">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/csmt-logo.jpeg" alt="CSMT Logo" class="img-responsive logo"></a>             
            </div>

            
            <?php 
            //var_dump($active_user);
            if (isset($active_user)) { if ($active_user->role_id=='3') { ?>
            <div class="navbar-right">
                <form id="navbar-search" class="navbar-form search-form">
                    <h3></h3>
               <h3><?php echo $active_user->fullname;?></h3>  
                </form>                

                <div id="navbar-menu">
                  <!--   <p></p>
                    <p style="font-size: 18px;"><?php echo $active_user->class_name.':'.$active_user->name; ?></p>
                    <p style="font-size: 18px;"><?php echo $active_user->username; ?> 
                    <a href="javascript:void(0);" class="dropdown icon-menu" data-toggle="dropdown"><i class="fa fa-chevron-down"></i></a></p>-->
                    <ul class="nav navbar-nav">
                        <li class="dropdown" style="list-style: none;">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown" style="font-size: 18px;"><?php echo $active_user->class_name.':'.$active_user->name; ?><br><?php echo $active_user->username; ?><i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu user-menu menu-icon">
                                <li class="menu-heading">ACCOUNT SETTINGS</li>
                                <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="icon-note"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <?php } } ?>
        </div>
    </nav>