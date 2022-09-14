<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Mikrotik</title>
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
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/jquery.gritter.css" />
    <script src="<?= base_url('public/'); ?>js/vue.js"></script>
    <script src="<?= base_url('public/'); ?>js/jnet.js"></script>
    <script src="<?= base_url('public/'); ?>js/sweetalert.js"></script>
    <script src="<?= base_url('public/'); ?>js/js.cookie.min.js"></script>

    <style>
    [v-cloak] {
        display: none;
    }
    </style>
</head>

<body>
    <script>
    // check id admin in storage
    const _TOKEN_ = "<?= _TOKEN_APP_ ?>";
    </script>
    <script src="<?= base_url('public/'); ?>init.js"></script>

    <script>
    const $id_router = "<?= $data_router->{'id_router'} ?>";
    const $username = "<?= $data_router->{'username_'} ?>";
    const $password = "<?= $data_router->{'password_'} ?>";
    const $ip_address = "<?= $data_router->{'ip_address'} ?>";
    const $port = "<?= $data_router->{'port_api'} ?>";

    function saveWork($btn) {
        localStorage.setItem('save_work', $btn);
    }
    </script>
    <!--Header-part-->
    <div id="header">
        <h1><a href="<?= base_url('admin'); ?>">My Mikrotik</a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <?php include('layout/header.php'); ?>

    <!--start-top-serch-->
    <?php include('layout/search.php'); ?>
    <!--close-top-serch-->

    <!--sidebar-menu-->
    <?php include 'layout/sidebar.php'; ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <?php include 'layout/small-header.php'; ?>
            </div>
        </div>

        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <li class="bg_lb"> <a onclick="saveSidebarActive('sidebar_dashboard');" href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/index" ?>">
                        <i class="icon-home"></i> My Dashboard </a> </li>
                <li class="bg_lg"> <a onclick="saveSidebarActive('sidebar_interface');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/interface" ?>"> <i
                            class="icon-tasks"></i> Interface</a> </li>
                <li class="bg_ly"> <a onclick="saveWork('btn_generate_user');saveSidebarActive('sidebar_useractive');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/useractive" ?>"> <i
                            class="icon-user"></i> User Active</a> </li>
                <li class="bg_lo"> <a onclick="saveSidebarActive('sidebar_hotspot_user_multiple');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-user-multiple" ?>"> <i
                            class="icon-group"></i> Voucher </a> </li>
                <li class="bg_ls"> <a onclick="saveSidebarActive('sidebar_ppp_interface');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ppp-interface" ?>"> <i
                            class="icon-signal"></i> PPP</a> </li>
            </ul>
        </div>

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">

                        <div id="placeholder2"></div>
                        <p>Time between updates:
                            <input id="updateInterval" type="text" value="" style="text-align: right; width:5em">
                            milliseconds</p>
                    </div>
                </div>

            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box widget-plain">
                        <div class="center">
                            <ul class="stat-boxes2" id="load_data" v-cloak>

                                <li>
                                    <div class="left peity_line_good"><span><span
                                                style="display: none;">12,6,9,23,14,10,17</span>
                                            <canvas width="50" height="24"></canvas>
                                        </span></div>
                                    <div class="right"> 
                                        <strong>{{ count_user_hotspot_active }}</strong> 
                                        <a onclick="saveSidebarActive('sidebar_hotspot');" href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/useractive" ?>">User Hotspot Active </a>
                                    </div>
                                </li>

                                <li>
                                    <div class="left peity_bar_good"><span>12,6,9,23,14,10,13</span></div>
                                    <div class="right"> <strong>{{ uptime }}</strong> 
                                    Uptime
                                    </div>
                                </li>

                                <li>
                                    <div class="left peity_bar_good"><span>12,6,9,23,14,10,13</span></div>
                                    <div class="right"> <strong>{{ count_all_user_hotspot }}</strong> 
                                    
                                    <a onclick="saveSidebarActive('sidebar_hotspot_user_multiple');" href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-user-multiple" ?>">All User Hotspot</a>
                                    </div>
                                </li>



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-part-->
    <?php include 'layout/footer.php'; ?>

    <!--end-Footer-part-->
    <script src="<?= base_url('public/'); ?>js/excanvas.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
    <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.flot.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.flot.resize.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.peity.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.chat.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.validate.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.form_validation.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.wizard.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>
    <script src="<?= base_url('public/'); ?>js/select2.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.popover.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.tables.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.interface.js"></script>
    <script src="<?= base_url('public/'); ?>js/jquery.gritter.min.js"></script>


    <script type="text/javascript">
    $(function() {
        // we use an inline data source in the example, usually data would
        // be fetched from a server
        var data = [],
            totalPoints = 300;

        function getRandomData() {
            if (data.length > 0)
                data = data.slice(1);

            // do a random walk
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50;
                var y = prev + Math.random() * 10 - 5;
                if (y < 0)
                    y = 0;
                if (y > 100)
                    y = 100;
                data.push(y);
            }

            // zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i)
                res.push([i, data[i]])
            return res;
        }

        // setup control widget
        var updateInterval = 30;
        $("#updateInterval").val(updateInterval).change(function() {
            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                if (updateInterval < 1)
                    updateInterval = 1;
                if (updateInterval > 2000)
                    updateInterval = 2000;
                $(this).val("" + updateInterval);
            }
        });

        // setup plot
        var options = {
            series: {
                shadowSize: 0
            }, // drawing is faster without shadows
            yaxis: {
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            }
        };
        var plot = $.plot($("#placeholder2"), [getRandomData()], options);

        function update() {
            plot.setData([getRandomData()]);
            // since the axes don't change, we don't need to call plot.setupGrid()
            plot.draw();

            setTimeout(update, updateInterval);
        }

        update();
    });
    </script>
    <script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-") {
                resetMenu();
            }
            // else, send page to designated URL            
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }

    function notifSuccess($message,$title){
        $.gritter.add({
            title:	$title,
            text:	$message,
            sticky: true
        });
    }

    </script>



    <script src="<?= base_url('public/') ?>auth-login.js"></script>


    <script src="<?= base_url('public/') ?>dashboard.js"></script>

    <script src="<?= base_url('public/') ?>identity.js"></script>

</body>

</html>