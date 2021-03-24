<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Mikrotik</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-style.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-media.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/jquery.gritter.css" />

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
        <h1><a href="#">My Mikrotik</a></h1>
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
            <div id="breadcrumb">
                <a href="<?= base_url('admin/index') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                    Home</a>

            </div>
        </div>
        <div class="quick-actions_homepage">

        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span6" id="router" v-cloak>
                    <div class="widget-box">
                        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i
                                    class="icon-chevron-down"></i></span>
                            <h5>
                                <strong v-cloak> {{ total_router }} Router
                                </strong>
                            </h5>

                        </div>
                        <div class="widget-content nopadding collapse in">
                            <br>
                            <div class="control-group">
                                   <center>
                                       
                            <span v-if="notif_not_found" class="label label-important" v-cloak>
                                Data tidak ditemukan
                            </span>
                            <br>
                                   <input class="span10" type="text" ref="search_query" @keypress="enterCari($event)"
                                        placeholder="Search by IP / Router Name" v-model="search_query">
                                   </center>
                                </div>
                            <hr>
                            <ul class="recent-posts">

                                <!-- data_router -->
                                <li v-for="router in data_router" v-cloak>
                                    <div class="user-thumb"> <img width="40" height="40" alt="User"
                                            src="<?= base_url('public/'); ?>img/router.svg"> </div>
                                    <div class="article-post"> <span class="user-info">
                                            <strong> <a href="#" @click="editRouter(router.ip_address,router.username_,router.password_,router.port_api,router.id_router,router.router_name)">{{ router.router_name }}</a>
                                            </strong>
                                        </span>
                                        <p>
                                            <i><small>{{ router.ip_address }}</small></i>
                                        </p>
                                        <p>
                                            <button
                                                @click="connect(router.ip_address,router.username_,router.password_,router.port_api,router.id_router)"
                                                class="btn btn-primary btn-mini">Connect</button>
                                            <button @click="pingRouter(router.ip_address,router.port_api)"
                                                class="btn btn-warning btn-mini">Ping</button>
                                            <!-- <button
                                                @click="editRouter(router.ip_address,router.username_,router.password_,router.port_api,router.id_router,router.router_name)"
                                                class="btn btn-secondary btn-mini">Edit</button> -->
                                            <button class="btn btn-danger btn-mini"
                                                @click="deleteRouter(router.id_router)">x</button>
                                        </p>
                                    </div>
                                </li>
                                <!-- data_router -->

                            </ul>
                            <hr>
                            <center>
                                <button v-if="show_btn" type="button" class="btn btn-mini btn-danger" onclick="clearRouter();"><i
                                        class="icon-trash"></i></button>
                               
                            </center>
                            <br>
                        </div>
                    </div>

                </div>
                <div class="span6" id="form_data" v-cloak>
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                            <h5>Add Router</h5>
                        </div>
                        <div class="widget-content">
                            <!-- form_data -->
                            <form class="form-horizontal" name="basic_validate" id="basic_validate"
                                novalidate="novalidate">

                                <div class="control-group" v-if="show_id_router">
                                    <label class="control-label">ID Router</label>
                                    <div class="controls">
                                        <input type="text" ref="id_router" v-model="id_router" placeholder="ID"
                                            name="id_router">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Router Name</label>
                                    <div class="controls">
                                        <input type="text" ref="router_name" @keypress="enterSave($event)"
                                            v-model="router_name" placeholder="RB3011" name="router_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">IP Address / DNS</label>
                                    <div class="controls">
                                        <input type="text" ref="ip_address" @keypress="enterSave($event)" @keyup="isIp"
                                            v-model="ip_address" placeholder="192.168.1.1" name="ip_address">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Port API</label>
                                    <div class="controls">
                                        <input type="text" ref="port_api" @keypress="enterSave($event)"
                                            v-model="port_api" placeholder="8728" name="port_api">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Username</label>
                                    <div class="controls">
                                        <input type="text" ref="username" @keypress="enterSave($event)"
                                            placeholder="admin" v-model="username" name="username">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input :type="text_or_password" ref="password" @keypress="enterSave($event)"
                                            placeholder="*****" v-model="password" name="password">
                                        <button @click="showPassword" type="button" class="btn btn-mini"><i class="icon-tint"></i></button>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="button" @click="save" value="Save" class="btn btn-success">
                                    <input type="button" @click="cancel" value="Cancel" class="btn btn-primary">
                                </div>
                            </form>
                            <!-- form_data -->
                        </div>
                    </div>

                </div>
            </div>
            <hr>

        </div>
    </div>
    <!--Footer-part-->
    <?php include 'layout/footer.php'; ?>


    <div id="modal_loading" class="modal hide">
        <div class="modal-header">
            <button id="btn_close_modal" data-dismiss="modal" class="close" type="button"></button>
            <h3></h3>
        </div>
        <div class="modal-body">
            <p>
                <center>
                    <img src="<?= base_url('public/img/loading.svg') ?>" alt="" width="50" height="50"></center>
                <h4 class="text-center">
                    Please Wait...
                </h4>
            </p>
        </div>
    </div>

    <a id="btn_show_modal" href="#modal_loading" data-toggle="modal" style="display: none"></a>

    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/excanvas.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.gritter.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.peity.min.js"></script>


    <script>
    // check id admin in storage
    const _TOKEN_ = "<?= _TOKEN_APP_ ?>";

    function notifSuccess() {
        $.gritter.add({
            title: 'Success !',
            text: 'Data Berhasil Disimpan',
            sticky: true
        });
    }
    function notifDanger($data) {
        $.gritter.add({
            title: 'Not Found',
            text: 'Uppz, '+$data+' tidak ditemukan !',
            sticky: true
        });
    }
    </script>

    <script src="<?= base_url('public/') ?>auth-login.js"></script>


    <script src="<?= base_url('public/') ?>home.js"></script>

</body>

</html>