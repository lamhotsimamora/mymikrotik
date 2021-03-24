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
        <h1><a href="#">IP Pool</a></h1>
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
                <a onclick="saveSidebarActive('sidebar_ippool');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/ippool" ?>" class="current">IP
                    POOL</a>

            </div>
            <h1>IP Pool</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                        <div class="widget-title">
                            <center>
                                <button href="#modal_add" data-toggle="modal"
                                    class="btn btn-primary btn-mini">+</button></center>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered" id="ippool" v-cloak>
                                <thead>
                                    <tr>
                                       
                                        <th>Name</th>
                                        <th>Ranges</th>
                                        <th>Next Pool</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data,i) in data_ippool">
                                      
                                        <td>{{data.name}}</td>
                                        <td>{{data.ranges}}</td>
                                        <td>{{data['next-pool']}}</td>
                                        <td>
                                            <button @click="removePool(data['.id']);"
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
    </div>
    <!--Footer-part-->
    <?php include dirname(__FILE__, 2) . '/layout/footer.php'; ?>

    <div id="modal_add" class="modal hide">
        <div class="modal-header">
            <button id="btn_close_modal" data-dismiss="modal" class="close" type="button">x</button>
            <h3></h3>
        </div>
        <div class="modal-body">
            <div class="control-group info">
                <label class="control-label" for="inputInfo">Name</label>
                <div class="controls">
                    <input type="text" placeholder="Name" ref="name" v-model="name" class="span4"></div>
            </div>

            <div class="control-group info">
                <label class="control-label" for="inputInfo">Address</label>
                <div class="controls">
                    <input type="text" placeholder="Address" ref="address" v-model="address" class="span4"></div>
            </div>

            <div class="control-group info">
                <label class="control-label" for="inputInfo">Next Pool</label>
                <div class="controls">
                    <input type="text" placeholder="Next Pool" ref="next_pool" v-model="next_pool" class="span4"></div>
            </div>


            <button @click="save" class="btn btn-primary ">Save</button>

        </div>
    </div>

    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>
    <script src="<?= base_url('public/'); ?>js/select2.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.tables.js"></script>



    <script src="<?= base_url('public/') ?>ippool.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>