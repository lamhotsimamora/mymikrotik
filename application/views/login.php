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
    <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-login.css" />
    <link href="<?= base_url('public/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url('public/css/'); ?>font-google.css" rel="stylesheet" />

    <link rel="icon" href="<?= base_url('public/') ?>img/router.png" type="image/gif" sizes="16x16">
    <script src="<?= base_url('public/') ?>js/jnet.js"></script>
    <script src="<?= base_url('public/') ?>js/vue.js"></script>
    <script src="<?= base_url('public/') ?>js/sweetalert.js"></script>
    <script src="<?= base_url('public/'); ?>js/js.cookie.min.js"></script>
    <style>
    [v-cloak] {
        display: none;
    }
    </style>
</head>

<body>
    <div id="loginbox" v-cloak>
        <form class="form-vertical">
            <div class="control-group normal_text">
                <h3><img src="<?= base_url('public/'); ?>img/logo.png" alt="Logo" /></h3>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                        <input v-model="username" @keypress="enterLogin($event)" ref="username" type="text" placeholder="Username" />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                        <input v-model="password" @keypress="enterLogin($event)" ref="password" :type="text_or_password" placeholder="Password" />
                        <br>
                        <a style="text-align: left;cursor: pointer" @click="showPassword">{{ text_button_show }}</a>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                &nbsp&nbsp&nbsp
                <center>
                <span class="pull-center"><a type="submit" href="#" @click="login" class="btn btn-success" />
                    Login</a></span>
                </center>
            </div>
        </form>

    </div>
    <script>
    const _TOKEN_ = "<?= _TOKEN_APP_ ?>";

    const __URL_SERVER_FROM_CI__ = "<?= __URL_SERVER__ ?>";
    </script>
    <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/matrix.login.js"></script>
    <script src="<?= base_url('public/'); ?>init.js"></script>
   

    <script src="<?= base_url('public/') ?>login.js"></script>
</body>

</html>