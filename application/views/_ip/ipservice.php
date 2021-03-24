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
        <h1><a href="#">IP Service</a></h1>
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
                <a onclick="saveSidebarActive('sidebar_ipservice');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/ipservice" ?>"
                    class="current">IP Service</a>

            </div>
            <h1>IP Service </h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box" id="ip_service" v-cloak>
                        <div class="widget-title">

                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Api</label>
                                    <div class="controls">
                                        <input :readonly="api_input_readonly" :id="id_api" v-model="api_port" ref="api_port" type="number"
                                            class="span8" placeholder="Api" />
                                        <span v-if="!api_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>

                                </div>

                                <div class="control-group">
                                    <label class="control-label">Api SSL</label>
                                    <div class="controls">
                                        <input :readonly="api_ssl_input_readonly" :id="id_apissl" v-model="apissl_port" ref="apissl_port" type="number"
                                            class="span8" placeholder="Api SSL" />
                                        <span v-if="!apissl_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">FTP</label>
                                    <div class="controls">
                                        <input :readonly="ftp_input_readonly" :id="id_ftp" v-model="ftp_port" ref="ftp_port" type="number"
                                            class="span8" placeholder="FTP" />
                                        <span v-if="!ftp_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">SSH</label>
                                    <div class="controls">
                                        <input :readonly="ssh_input_readonly" :id="id_ssh" v-model="ssh_port" ref="ssh_port" type="number"
                                            class="span8" placeholder="SSH" />
                                        <span v-if="!ssh_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Telnet</label>
                                    <div class="controls">
                                        <input :readonly="telnet_input_readonly" :id="id_telnet" v-model="telnet_port" ref="telnet_port" type="number"
                                            class="span8" placeholder="Telnet" />
                                        <span v-if="!telnet_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Winbox</label>
                                    <div class="controls">
                                        <input :readonly="winbox_input_readonly" :id="id_winbox" v-model="winbox_port" ref="winbox_port" type="number"
                                            class="span8" placeholder="Winbox" />
                                        <span v-if="!winbox_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">www</label>
                                    <div class="controls">
                                        <input :readonly="www_input_readonly" :id="id_www" v-model="www_port" ref="www_port" type="number"
                                            class="span8" placeholder="www" />
                                        <span v-if="!www_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">www SSL</label>
                                    <div class="controls">
                                        <input :readonly="wwwssl_input_readonly" :id="id_wwwssl" v-model="wwwssl_port" ref="wwwssl_port" type="number"
                                            class="span8" placeholder="www SSL" />
                                        <span v-if="!wwwssl_enabled" class="label label-success">Enabled</span>
                                        <span v-else class="label label-important">Disabled</span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <div class="controls">
                                        <button type="button" @click="update"
                                            class="btn btn-primary btn-sm">Save</button>
                                    </div>
                                </div>

                            </form>
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


    <script src="<?= base_url('public/') ?>ipservice.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>