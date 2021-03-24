<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Mikrotik</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/uniform.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/select2.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-style.css" />
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-media.css" />
    <link href="<?= base_url('public/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url('public/css/'); ?>font-google.css" rel="stylesheet" />
    <link rel="icon" href="<?= base_url('public/') ?>img/router.png" type="image/gif" sizes="16x16">
    <script src="<?= base_url('public/'); ?>js/vue.js"></script>
    <script src="<?= base_url('public/'); ?>js/js.cookie.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jnet.js"></script>
    <style>
    [v-cloak] {
        display: none;
    }
    </style>
</head>

<body>

    <script src="<?= base_url('public/'); ?>init.js"></script>
    <script>
    // check id admin in storage
    const _TOKEN_ = "<?= _TOKEN_APP_ ?>";
    </script>
    <script>
    const $id_router = "<?= $data_router->{'id_router'} ?>";
    const $username = "<?= $data_router->{'username_'} ?>";
    const $password = "<?= $data_router->{'password_'} ?>";
    const $ip_address = "<?= $data_router->{'ip_address'} ?>";
    const $port = "<?= $data_router->{'port_api'} ?>";
    </script>

    <!--Header-part-->
    <div id="header">
        <h1><a href="#">Wireless Registration</a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <?php include 'layout/header.php'; ?>

    <!--start-top-serch-->
    <?php include('layout/search.php'); ?>
    <!--close-top-serch-->

    <!--sidebar-menu-->
    <?php include 'layout/sidebar.php'; ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <?php include 'layout/small-header.php'; ?>
                <a onclick="saveSidebarActive('sidebar_wireless_registration');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/wireless-registration" ?>"
                    class="current">Wireless Registration</a>

            </div>
            <h1>Wireless Registration</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box" id="wireless-registration" v-cloak>
                        <div class="widget-title">
                            <center>
                                <button v-if="show_table" @click="reconnect" type="button"
                                    class="btn btn-danger btn-xs">Reconnect</button>
                            </center>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered" v-if="show_table">
                                <thead>
                                    <tr>
                                        <th>Interface</th>
                                        <th>Radio Name</th>
                                        <th>MAC</th>
                                        <th>WDS</th>
                                        <th>Uptime</th>
                                        <th>Signal Strength</th>
                                        <th>Signal Strength ch0</th>
                                        <th>Signal Strength ch1</th>
                                        <th>Throughput</th>
                                        <th>TX CCQ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data,i) in data_wireless_registration">
                                        <td>{{data['interface']}}</td>
                                        <td>{{data['radio-name']}}</td>
                                        <td>{{data['mac-address']}}</td>
                                        <td>{{data['wds']}}</td>
                                        <td>{{data['uptime']}}</td>
                                        <td>{{data['signal-strength']}}</td>
                                        <td>{{data['signal-strength-ch0']}}</td>
                                        <td>{{data['signal-strength-ch1']}}</td>
                                        <td>{{data['p-throughput']}}</td>
                                        <td>{{data['tx-ccq']}}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
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
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>
    <script src="<?= base_url('public/'); ?>js/select2.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.tables.js"></script>


    <script src="<?= base_url('public/') ?>wireless-registration.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>

    <script>

    </script>
</body>

</html>