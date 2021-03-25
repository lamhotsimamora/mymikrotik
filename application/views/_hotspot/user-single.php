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
        <h1><a href="#">New User </a></h1>
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
                <a onclick="saveSidebarActive('sidebar_hotspot_user_single');"
                    href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/hotspot-user-single" ?>"
                    class="current">New User </a>

            </div>
            <h1>New User </h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class="widget-box">

                        <div class="widget-content">

                            <div id="form_generate_user" v-if="show_form" class="" v-cloak>
                                <div class="control-group">
                                    <label class="control-label">Select Server <button class="btn btn-primary btn-sm"
                                            onclick="goToHotspotServer();">+</button></label>
                                    <div class="controls">
                                        <select id="select_server" v-model="servers" class="form-control">
                                            <option :value="servers.name" v-for="servers in data_server">
                                                {{ servers.name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Select Profile <button class="btn btn-primary btn-sm"
                                            onclick="goToHotspotProfile();">+</button>
                                        <strong>{{ rate_limit }}</strong></label>
                                    <div class="controls">
                                        <select @change="selectProfile(profile.rate_limit)" v-model="profile"
                                            class="form-control">
                                            <option :value="{
                         name : profile.name,
                         rate_limit : profile['rate-limit']
                      }" v-for="profile in data_profile">{{ profile.name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Time Limit (1h = 1 jam)</label>
                                    <div class="controls">
                                        <input type="number" class="form-control" ref="time_limit" v-model="time_limit"
                                            placeholder="Time Limit" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Comment</label>
                                    <div class="controls">
                                        <input type="text" @keyup="rejectSpace" class="form-control" ref="comment"
                                            v-model="comment" placeholder="Comment" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Length</label>
                                    <div class="controls">
                                        <input type="number" class="form-control" ref="length" v-model="length"
                                            placeholder="Length Username & Password" />
                                    </div>
                                    <center>
                                        <button @click="add" :disabled="disabled_button"
                                            class="btn btn-primary btn-mini">Add</button>
                                    </center>
                                </div>
                            </div>
                            <center>
                                <button id="btn_show_form" @click="showForm" v-if="show_button"
                                    class="btn btn-primary btn-mini">Add New User</button>
                            </center>
                            <hr>
                            <div class="control-group" id="select_comment" v-cloak>
                                <label class="control-label">Filter By Comment</label>
                                <div class="controls">
                                    <select class="form-control" @change="loadDataByComment($event)" v-model="comments"
                                        class="form-control">
                                        <option :value="comments" v-for="comments in data_comments">{{ comments }}
                                        </option> 
                                    </select> 
                                    <strong>{{ jml_comment }}</strong>
                                </div>
                                <button class="btn btn-secondary btn-sm" @click="printVoucher">Print</button>
                                <button class="btn btn-primary btn-sm" @click="printAll">Print All</button>
                                <button class="btn btn-success btn-sm" @click="refresh">Refresh</button>
                            </div>

                            <center id="loading" v-cloak>
                                <img v-if="show" src="<?= base_url('public/img/loading.svg') ?>" alt="" width="30"
                                    height="30"><br>
                            </center>

                            <div class="table-responsive">
                            <input id="search_tmp" class="span5" type="text" ref="search_query" @keypress="enterCari($event)"
                                        placeholder="Search User" v-model="search_query" :disabled="enabled" v-cloak> 
                                <table class="table table-bordered" id="data_hotspot_users" v-if="show" v-cloak>
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Server</th>
                                            <th>Profile</th>
                                            <th>Uptime</th>
                                            <th>Comment</th>
                                            <th>Limit Uptime</th>
                                            <th>Bytes In </th>
                                            <th>Bytes Out</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(data,i) in data_hotspot_users">

                                            <td>{{data.name}}</td>
                                            <td>{{data['password']}}</td>
                                            <td>{{data.server}}</td>
                                            <td>{{data.profile}}</td>
                                            <td>{{data.uptime}}</td>
                                            <td>{{data.comment}}</td>
                                            <td>{{data['limit-uptime']}}</td>
                                            <td>{{convertByte(data['bytes-in'])}}</td>
                                            <td>{{convertByte(data['bytes-out'])}}</td>
                                            <td>
                                                <button @click="deleteData(data['.id'])"
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
    <?php include dirname(__FILE__, 2) . '/layout/footer.php'; ?>



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
    <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>



    <script>
      const find_user_auto = localStorage.getItem("find_user_from_page_user_active");
    
    function goToHotspotServer() {
        window.location.href =
            "<?= base_url('admin/router/') . $data_router->{'id_router'}."/hotspot-server" ?>";
    }

    function goToHotspotProfile() {
        window.location.href = "<?= base_url('admin/router/') . $data_router->{'id_router'}."/hotspot-user-profile " ?>";
    }

    function goToSingleUser() {
        window.location.href = "<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-user-single " ?>";
    }
    </script>
    <script src="<?= base_url('public/') ?>user-generate.js"></script>
    <script src="<?= base_url('public/') ?>user-single.js"></script>
    <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>