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
    <script src="<?= base_url('public/'); ?>js/sweetalert.js"></script>
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
    <script src="<?= base_url('public/') ?>auth-login.js"></script>
    <script>
    const $id_router = "<?= $data_router->{'id_router'} ?>";
    const $username = "<?= $data_router->{'username_'} ?>";
    const $password = "<?= $data_router->{'password_'} ?>";
    const $ip_address = "<?= $data_router->{'ip_address'} ?>";
    const $port = "<?= $data_router->{'port_api'} ?>";
    </script>


    <!--Header-part-->
    <div id="header">
        <h1><a href="#">IP Route</a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <?php include dirname(__FILE__, 2) . '/layout/header.php'; ?>

    <!--start-top-serch-->
    <?php include dirname(__FILE__, 2) .('/layout/search.php'); ?>

    <!--close-top-serch-->

    <!--sidebar-menu-->
    <?php include dirname(__FILE__, 2) . '/layout/sidebar.php'; ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <?php include dirname(__FILE__, 2).'/layout/small-header.php'; ?>
                <a onclick="saveSidebarActive('sidebar_iproute');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/iproute" ?>" class="current">IP
                    Route</a>


            </div>

            <h1>IP Route</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon">
                                <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                            </span>
                            <h5></h5>
                        </div>
                        <div class="widget-content nopadding" id="iproute" v-cloak>
                            <form class="form-horizontal" name="basic_validate" id="basic_validate"
                                novalidate="novalidate">
                                <div class="control-group">
                                    <label class="control-label">DST Address</label>
                                    <div class="controls">
                                        <input type="text" v-model="dst_address_1">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Gateway</label>
                                    <div class="controls">
                                        <input type="text" v-model="gateway_1">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Gateway Status</label>
                                    <div class="controls">
                                        <input type="text" v-model="gateway_status">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Disabled</label>
                                    <div class="controls">
                                        <input type="text" v-model="disabled">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Active</label>
                                    <div class="controls">
                                        <input type="text" v-model="active">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Distance</label>
                                    <div class="controls">
                                        <input type="text" v-model="distance">
                                    </div>
                                </div>

                            </form>

                            <hr>
                            <table class="table table-bordered" v-cloak>
                                <thead>
                                    <tr>
                                       
                                        <th>DST Address</th>
                                        <th>Gateway</th>
                                        <th>Pref Source</th>
                                        <th>Gateway Status</th>
                                        <th>Connect</th>
                                        <th>Active</th>
                                        <th>Disabled</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data,i) in data_iproute">
                                       
                                        <td>{{data['dst-address']}}</td>
                                        <td>{{data.gateway}}</td>
                                        <td>{{data['pref-src']}}</td>
                                        <td>{{data['gateway-status']}}</td>
                                        <td>{{data['connect']}}</td>
                                        <td>{{data['active']}}</td>
                                        <td>{{data['disabled']}}</td>
                                        <!-- <td>
                                            <button class="btn btn-danger btn-mini">x</button>
                                        </td> -->
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
    <?php include dirname(__FILE__, 2) . '/layout/footer.php'; ?>

    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>
    <script src="<?= base_url('public/'); ?>js/select2.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.tables.js"></script>


    <script src="<?= base_url('public/') ?>iproute.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>