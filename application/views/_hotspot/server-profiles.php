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

    const $id_router = "<?= $data_router->{'id_router'} ?>";
    const $username = "<?= $data_router->{'username_'} ?>";
    const $password = "<?= $data_router->{'password_'} ?>";
    const $ip_address = "<?= $data_router->{'ip_address'} ?>";
    const $port = "<?= $data_router->{'port_api'} ?>";
    </script>

    <script src="<?= base_url('public/') ?>auth-login.js"></script>


    <!--Header-part-->
    <div id="header">
        <h1><a href="#">Hotspot Server Profiles</a></h1>
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
                <a onclick="saveSidebarActive('sidebar_hotspot_server_profiles','sidebar_hotspot');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/hotspot_profile_server" ?>"
                    class="current">Hotspot Server Profile </a>

            </div>
            <h1>Hotspot Server Profiles</h1>
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

                            <center id="loading" v-cloak> <br>
                                <img v-if="show" src="<?= base_url('public/img/loading.svg') ?>" alt="" width="30"
                                    height="30"><br>
                            </center>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered" id="data_hotspot_profiles" v-cloak>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>DNS Name</th>
                                        <th>HTML Directory</th>
                                        <th>Rate Limit (tx/rx)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data,i) in data_hotspot_profiles">
                                        <td>{{i++}}</td>
                                        <td>{{data.name}}</td>
                                        <td>{{data['dns-name']}}</td>
                                        <td>{{data['html-directory']}}</td>
                                        <td>{{data['rate-limit']}}</td>
                                        <td>
                                            <button class="btn btn-danger btn-mini">x</button>
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
              <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                <input type="text" class="span4" ref="name" v-model="name" placeholder="Name" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Hotspot Address</label>
                <div class="controls">
                <input type="text" class="span4" ref="hotspot_address" v-model="hotspot_address" placeholder="Hotspot Address" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">DNS Name</label>
                <div class="controls">
                <input type="text" class="span4" ref="dns_name" v-model="dns_name" placeholder="DNS Name" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">HTML Directory</label>
                <div class="">
                <select v-model="htmldirectory">
                    <option v-for="htmldirectory in data_htmldirectory" :value="htmldirectory.name">{{htmldirectory.name}}</option>
                </select>
                </div>
            </div>

            <button class="btn btn-primary btn-md" @click="save">Save</button>

        </div>
    </div>


    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>
  
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>



    <script>
    let $loading = new Vue({
        el: '#loading',
        data: {
            show: true
        }
    })
    </script>
    <script src="<?= base_url("public/") ?>server-profiles.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>