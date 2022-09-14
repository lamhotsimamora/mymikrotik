<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Client</title>
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

    <script src="<?= base_url('public/'); ?>js/garuda.js"></script>
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
    <?php include dirname(__FILE__, 2) . '/layout/header.php'; ?>

    <!--start-top-serch-->
    <?php include dirname(__FILE__, 2) . '/layout/search.php'; ?>
    <!--close-top-serch-->

    <!--sidebar-menu-->
    <?php include dirname(__FILE__, 2) . '/layout/sidebar_router.php'; ?>

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
                                    class="icon-chevron-down"></i></span>  <h4>Client</h4>

                        </div>
                        <div class="widget-content nopadding collapse in">
                            <div id="client" class="widget-content nopadding" v-cloak> <br>
                                <center>
                                    <button href="#modal_add" data-toggle="modal"
                                        class="btn btn-primary btn-sm">+ Add Client</button>
                                        <button @click="goToBandwith" class="btn btn-secondary btn-sm">+ Add Bandwith</button>
                                    <button @click="goToPayment" class="btn btn-success btn-sm">+ Add Payment</button> <br> <br>
                                    
                                    <div class="controls">
                                        <input ref="search" type="text" v-model="search"  @keypress="enterSearch($event)" class="span15" placeholder="Cari" />
                                    </div>
                                    <hr>
                                </center>
                                <table class="table table-bordered" v-cloak>
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis Jaringan</th>
                                            <th>Bandwith</th>
                                            <th>Harga</th>
                                            <th>Tgl Pasang</th>
                                            <th>@</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(data,i) in data_client">
                                            <td>{{data.nama}}</td>
                                            <td>{{data.jenis}}</td>
                                            <td>{{data.bandwith}} MB</td>
                                            <td>{{_moneyFormat(data.price)}} </td>
                                            <td>{{data.tgl_pasang}}</td>
                                            <td>
                                                <button @click="deleteData(data.id_client)"
                                                    class="btn btn-danger btn-mini">x</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

    <div id="modal_add" class="modal hide">
        <div class="modal-header">
            <button id="btn_close_modal" data-dismiss="modal" class="close" type="button">x</button>
            <h3></h3>
        </div>
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input type="text" class="span4" ref="nama" v-model="nama" placeholder="Name" />
                </div>
            </div>


            <div class="control-group">
                <label class="control-label">Bandwith</label>
                <div class="controls">
                    <select v-model="bandwith">
                        <option v-for="bandwith in data_bandwith" :value="bandwith.id_bandwith">{{bandwith.bandwith}} MB
                        </option>
                    </select>
                    <button onclick="goToBandwithPage();" class="btn btn-primary btn-sm">+</button>
                </div>

            </div>

            <div class="control-group">
                <label class="control-label">Jenis</label>
                <div class="controls">
                    <select v-model="jenis">
                        <option v-for="jenis in data_jenis" :value="jenis.id_jenis">{{jenis.jenis}}</option>
                    </select>
                    <button onclick="goToJenisPage();" class="btn btn-primary btn-sm">+</button>
                </div>

            </div>

            <div class="control-group">
                <label class="control-label">Tgl Pasang</label>
                <div class="controls">
                    <input type="date" class="span4" ref="tgl_pasang" v-model="tgl_pasang" placeholder="Tgl Pasang" />
                </div>
            </div>

            <button class="btn btn-primary btn-md" @click="save">Save</button>

        </div>
    </div>


    <!--Footer-part-->

    <?php include dirname(__FILE__, 2) . '/layout/footer.php'; ?>



    <a id="btn_show_modal" href="#modal_loading" data-toggle="modal" style="display: none"></a>

    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/excanvas.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>


    <script>
    // check id admin in storage
    const _TOKEN_ = "<?= _TOKEN_APP_ ?>";

    function goToJenisPage() {
        window.location.href = URL_SERVER + 'admin/client/jenis';
    }

    function goToBandwithPage() {
        window.location.href = URL_SERVER + 'admin/client/bandwith';
    }
    </script>

    <script src="<?= base_url('public/') ?>auth-login.js"></script>


    <script src="<?= base_url('public/') ?>client.js"></script>



</body>

</html>