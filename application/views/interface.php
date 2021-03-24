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
    .pointer {cursor: pointer;}
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
        <h1><a href="#">Interface</a></h1>
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
                <a onclick="saveSidebarActive('sidebar_interface');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/interface" ?>"
                    class="current">Interface</a>
            </div>
            <h1>Interface</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                      
                        <div class="widget-content nopadding">
                            <table class="table table-bordered" id="interface" v-cloak>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>MAC Address</th>
                                        <th>Type</th>
                                        <th>Tx Total</th>
                                        <th>Rx Total</th>
                                        <th>Status (Running)</th>
                                        <th>Enable</th>
                                        <th>@</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(interface,i) in data_interface">
                                        
                                        <td class="pointer" href="#modal_interface" data-toggle="modal" @click="sendId(interface['.id'],interface['name'])"  v-html="checkEnableDisableName(interface.name,interface['disabled'])"></td>
                                        
                                        <td>{{interface['mac-address']}}</td>
                                        <td>{{interface.type}}</td>
                                        <td class="center" v-html="convertByte(interface['tx-byte'])"></td>
                                        <td class="center" v-html="convertByte(interface['rx-byte'])"></td>
                                        <td>{{interface.running}}</td>
                                        <td v-html="templateEnabled(interface.disabled)"></td>
                                        <td>

                                            <button @click="enabledDisabled(interface['disabled'],interface['.id'])"
                                                class="btn btn-secondary btn-mini"
                                                v-html="checkEnableDisable(interface['disabled'])"></button>
                                            
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
    <?php include 'layout/footer.php'; ?>

    <div id="modal_interface" class="modal hide">
    <div class="modal-header">
      <button id="btn_close_modal" data-dismiss="modal" class="close" type="button">x</button>
      <h3></h3>
    </div>
    <div class="modal-body">

      <div class="control-group">
        <label class="control-label">New Name</label>
        <div class="controls">
          <input type="text" class="span4" ref="name" v-model="name" placeholder="New Name" />
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
    <script src="<?= base_url('public/'); ?>js/select2.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.tables.js"></script>


    <script src="<?= base_url('public/') ?>interface.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>