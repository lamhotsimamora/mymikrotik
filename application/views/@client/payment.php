<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment</title>
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
                                    class="icon-chevron-down"></i></span>  <h4>Payment</h4>

                        </div>
                        <script type="text/javascript">
                            function back(){
                                $server = "<?= base_url()?>";

                                window.location.href=$server+"admin/client";
                            }
                        </script>
                        <div class="widget-content nopadding collapse in">
                            <div id="payment" class="widget-content nopadding" v-cloak>
                                <center>
                                    <button onclick="back()"
                                        class="btn btn-success btn-sm">Back</button>
                                    <button href="#modal_add" data-toggle="modal"
                                        class="btn btn-primary btn-sm">+</button>
                                </center>
                                <table class="table table-bordered" v-cloak>
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Bandwith</th>
                                            <th>Tgl Pasang</th>
                                            <th>Tgl Bayar</th>
                                            <th>Jml Bayar</th>
                                            <th>@</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(data) in data_payment">
                                            <td>{{data.nama}}</td>
                                            <td>{{data.bandwith}} MB </td>
                                            <td>{{data.tgl_pasang}}</td>
                                            <td>{{data.tgl_bayar}}</td>
                                            <td>{{_moneyFormat(data.jml_pay)}}</td>
                                            <td>
                                                <button @click="deleteData(data.id_payment)"
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
            <h3>Payment</h3>
        </div>
        <div class="modal-body">
        <div class="control-group">
        <label class="control-label">Client</label>
       
        <div class="controls">
          <select v-model="client" @change="selectBandwith" >
            <option v-for="client in data_client" v-bind:name="client.price" :value="{id:client.id_client,price:client.price}"
                >{{client.nama}} , {{ client.bandwith }} MB 
            </option>
          </select>
          <button onclick="goToClientPage();" class="btn btn-primary btn-sm">+</button>
        </div>
       
      </div> 

        <div class="control-group">
            <label class="control-label">Jumlah Bayar</label>
            <div class="controls">
                <input type="text" class="span4" ref="jml_pay" v-model="jml_pay" placeholder="Jmlh Bayar" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Tgl Bayar</label>
            <div class="controls">
                <input type="date" class="span4" ref="tgl_bayar" v-model="tgl_bayar" placeholder="Tgl Bayar" />
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
        window.location.href = URL_SERVER + 'admin/jenis';
    }

    function goToClientPage(){
        window.location.href = URL_SERVER + 'admin/client';
    }
    </script>

    <script src="<?= base_url('public/') ?>auth-login.js"></script>


    <script src="<?= base_url('public/') ?>payment.js"></script>



</body>

</html>