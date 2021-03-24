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
        <h1><a href="#">IP Firewall NAT</a></h1>
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
                <a onclick="saveSidebarActive('sidebar_ipfirewall');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/ipfirewall" ?>"
                    class="current">IP Firewall NAT</a>

            </div>
            <h1>IP Firewall NAT</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon">
                                <input type="checkbox" id="title-checkbox" name="title-checkbox" />
                                   
                            </span>
                            <center>
                                    <button href="#modal_add" data-toggle="modal" class="btn btn-primary btn-mini">+</button>
                                    </center>
                        </div>
                        <div class="widget-content nopadding">
                        <div class="table-responsive">

                            <table class="table table-bordered table-responsive" id="ipfirewall" v-cloak>
                                <thead>
                                    <tr>
                                        <th>Comment</th>
                                        <th>Action</th>
                                        <th>Chain</th>
                                        <th>Src Address</th>
                                        <th>Dynamic</th>
                                        <th>Dst Address</th>
                                        <th>Dst Port</th>
                                        <th>To Address</th>
                                        <th>To Port</th>
                                        <th>Protocol</th>
                                        <th>Enable</th>
                                        <th>@</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data,i) in data_ipfirewall">

                                        <td style="color:black" v-html="checkEnableDisableComment(data.comment,data['disabled'])"></td>
                                        <td>{{data.action}}</td>
                                        <td>{{data.chain}}</td>
                                        <td>{{data['src-address']}}</td>
                                        <td>{{data.dynamic}}</td>
                                        <td>{{data['dst-address']}}</td>
                                        <td>{{data['dst-port']}}</td>
                                        <td>{{data['to-addresses']}}</td>
                                        <td>{{data['to-ports']}}</td>
                                        <td>{{data['protocol']}}</td>
                                        <td v-html="templateEnabled(data['disabled'])"></td>
                                        <td>

                                            <button @click="enabledDisabled(data['disabled'],data['.id'])"
                                                class="btn btn-secondary btn-mini"
                                                v-html="checkEnableDisable(data['disabled'])">
                                                
                                                </button>
                                            <button @click="deleteFirewall(data['.id'])"
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
    </div>
    <!--Footer-part-->

    <div id="modal_add" class="modal hide">
    <div class="modal-header">
      <button id="btn_close_modal" data-dismiss="modal" class="close" type="button">x</button>
      <h3></h3>
    </div>
    <div class="modal-body">
      <div class="control-group">
        <label class="control-label">Src. Address</label>
        <div class="controls">
          <input type="text" class="span4" ref="src_address" v-model="src_address" placeholder="15.15.15.0/24" />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Chain</label>
        <div class="controls">
          <select v-model="chain">
            <option v-for="chain in data_chain" :value="chain.type">{{chain.type}}</option>
          </select>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Action</label>
        <div class="controls">
          <select v-model="action">
            <option v-for="action in data_action" :value="action.type">{{action.type}}</option>
          </select>
        </div>
      </div>


      <button class="btn btn-primary btn-md" @click="save">Save</button>

    </div>
  </div>


    <?php include dirname(__FILE__, 2) . '/layout/footer.php'; ?>


    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>

    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>



    <script src="<?= base_url('public/') ?>ipfirewall.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>