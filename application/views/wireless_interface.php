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
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/jquery.gritter.css" />
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
        <h1><a href="#">Wireless Interface</a></h1>
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
                <a onclick="saveSidebarActive('sidebar_wireless_interface');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/wireless-interface" ?>"
                    class="current">Wireless Interface</a>

            </div>
            <h1>Wireless Interface</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box" id="wireless-interface" v-cloak>
                        <div class="widget-title">

                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" v-if="show_form">

                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <input v-model="name" ref="name" type="text" class="span10"
                                            placeholder="Name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Radio Name</label>
                                    <div class="controls">
                                        <input v-model="radio_name" ref="radio_name" type="text" class="span10"
                                            placeholder="Radio Name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">SSID</label>
                                    <div class="controls">
                                        <input v-model="ssid" ref="ssid" type="text" class="span10"
                                            placeholder="SSID" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Mode</label>
                                    <div class="controls">
                                        <input v-model="mode" ref="mode" type="text" class="span10"
                                            placeholder="Mode" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Frequency</label>
                                    <div class="controls">
                                        <input v-model="frequency" ref="frequency" type="text" class="span10"
                                            placeholder="Frequency" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Band</label>
                                    <div class="controls">
                                        <input v-model="band" ref="band" type="text" class="span10"
                                            placeholder="Band" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Channel Width</label>
                                    <div class="controls">
                                        <input v-model="channel_width" ref="channel_width" type="text" class="span10"
                                            placeholder="Channel Width" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Wireless Protocol</label>
                                    <div class="controls">
                                        <input v-model="wireless_protocol" ref="wireless_protocol" type="text"
                                            class="span10" placeholder="Wireless Protocol" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Security Profile</label>
                                    <div class="controls">
                                        <input v-model="security_profile" ref="security_profile" type="text"
                                            class="span10" placeholder="Security Profile" />
                                        <button type="button" @click="showNotif"
                                            class="btn btn-primary btn-sm">?</button>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Interface Type</label>
                                    <div class="controls">
                                        <input v-model="interface_type" ref="interface_type" type="text" class="span10"
                                            placeholder="Interface Type" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Country</label>
                                    <div class="controls">
                                        <input v-model="country" ref="country" type="text" class="span10"
                                            placeholder="Country" />
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

    <script src="<?= base_url('public/'); ?>js/jquery.gritter.min.js"></script>

    <script src="<?= base_url('public/') ?>wireless-interface.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>

    <script>
    const $show_notif = false

    function notifSuccess($message, $title, $show_notif = false) {
        if ($show_notif == false) {
            return;
        }
        $.gritter.add({
            title: $title,
            text: $message,
            sticky: true
        });
    }
    </script>
</body>

</html>