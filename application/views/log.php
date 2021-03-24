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
        <h1><a href="#">LOG</a></h1>
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
                <a onclick="saveSidebarActive('sidebar_log');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/log" ?>"
                    class="current">Log</a>

            </div>
            <h1>LOG </h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box" id="log" v-cloak>
                        <div class="widget-title">
                            <center>
                                <h4> Total : {{ total }} Logs</h4>
                            </center>
                        </div>
                        <div class="widget-content nopadding">
                            <br>
                            <!-- content -->
                            <div class="alert" v-for="data in data_log">
                              
                                <strong> <small>{{ data.time }}</small> </strong> {{ data.message }}
                            </div>
                            <!-- content -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--Footer-part-->
    <?php include 'layout/footer.php'; ?>

    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>
    <script src="<?= base_url('public/'); ?>js/select2.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.tables.js"></script>


    <script src="<?= base_url('public/') ?>log.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>