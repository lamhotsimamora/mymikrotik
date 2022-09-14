<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-style.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-media.css" />
    <link href="<?= base_url('public/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url('public/css/'); ?>font-google.css" rel="stylesheet" />
    <link rel="icon" href="<?= base_url('public/') ?>img/router.png" type="image/gif" sizes="16x16">
    <script src="<?= base_url('public/'); ?>js/vue.js"></script>
    <script src="<?= base_url('public/'); ?>js/jnet.js"></script>
    <script src="<?= base_url('public/'); ?>js/sweetalert.js"></script>
    <script src="<?= base_url('public/'); ?>js/js.cookie.min.js"></script>

    <style>
    [v-cloak] {
        display: none;
    }
    </style>
</head>

<body>
    
<script src="<?= base_url('public/'); ?>init.js"></script>
    <!--Header-part-->
    <div id="header">
        <h1><a href="dashboard.html">My Mikrotik</a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <?php include('layout/header.php'); ?>

    <!--start-top-serch-->
    <?php include('layout/search.php'); ?>
    <!--close-top-serch-->

    <!--sidebar-menu-->
    <?php include 'layout/sidebar_router.php'; ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="<?= base_url('admin/index') ?>" title="Go to Home" class="tip-bottom"><i
                        class="icon-home"></i> Home</a></div>
        </div>
        <div class="quick-actions_homepage">

        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i
                                    class="icon-chevron-down"></i></span>

                        </div>
                        <div class="widget-content nopadding collapse in">
                            <div id="change-password" class="widget-content nopadding">
                                <form class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">New Username</label>
                                        <div class="controls">
                                            <input v-model="new_username" ref="new_username" type="text" class="span11"
                                                placeholder="First name" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">New Password</label>
                                        <div class="controls">
                                            <input v-model="new_password" type="password" class="span11"
                                                placeholder="Enter Password" />
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                    <center>
                                        <button type="button" @click="update" class="btn btn-success">Save</button>
                                    </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <hr>
            <div class="row-fluid">
                <div class="span12">

                </div>
            </div>
        </div>
    </div>
    <!--Footer-part-->
    <?php include 'layout/footer.php'; ?>



    <a id="btn_show_modal" href="#modal_loading" data-toggle="modal" style="display: none"></a>

    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/excanvas.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
 

    <script>
    // check id admin in storage
    const _TOKEN_ = "<?= _TOKEN_APP_ ?>";
    </script>

    <script src="<?= base_url('public/') ?>auth-login.js"></script>


    <script src="<?= base_url('public/') ?>change-password.js"></script>

    <script>



    </script>

</body>

</html>