<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Standart Voucher</title>
    <script src="<?= base_url('public/'); ?>js/js.cookie.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/vue.js"></script>
    <link href="<?= base_url('public/css/'); ?>font-google.css" rel="stylesheet" />
    <link rel="icon" href="<?= base_url('public/') ?>img/router.png" type="image/gif" sizes="16x16">
    <style>
    [v-cloak] {
        display: none;
    }

    .container {
        display: grid;
        width: 100px;
        margin: auto auto;
        grid-template-columns: auto auto auto  ;
        grid-template-rows: auto auto auto ;
    }

    .voucher {
        width: 150px;
        height: 260px;
        background:#22a6b3;
        position: relative;
        border: 1px solid grey;
        margin: 2px 15px 11px 11px;
    }

    .small {
        font-size: 5;
        font-family: 'Courier New', Courier, monospace;
        color: #ecf0f1;
    }

    .big {
        font-size: 5;
        font-family: 'Courier New', Courier, monospace;
        color: #130f40;
    }
    </style>
</head>

<body><br>

    <div id="app" class="container" v-cloak>
        <div v-for="(data_user) in data_user">
            <div class="voucher">
                <center>
                    <img class="img" src="<?= base_url('public/') ?>img/logo.png" alt="">
                </center>
                <hr>
                <center class="small">Username</center> <br>
                <center class="big"><strong>{{ data_user.username }}</strong> </center>
                <hr>
                <center class="small">Password</center><br>
                <center class="big"><strong>{{ data_user.password }}</strong></center>
                <hr>
                <center class="small">Limit : {{data_user['limit']}} <br>
                    <hr>
                    <strong class="small">
                        {{data_user.identity}}
                    </strong>
            </div><br>
        </div>
        <div id="space" v-cloak>
            <br><br>
        </div>
    </div>
</body>
<script>
    
if (!localStorage.getItem('data_voucher_ready_to_print')) {
    window.location.href = URL_SERVER + 'admin/index';
}

new Vue({
    el: '#app',
    data: {
        data_user: null
    },
    methods: {
        load: function() {
            let $data_user = JSON.parse(localStorage.getItem('data_voucher_ready_to_print'));
            let identity = Cookies.get('identity_mikrotik');

            // get all data voucher and add identity
            let $data_voucher = [];
            let length_voucher = $data_user.length;

            if (length_voucher > 20) {
                for (let index = 0; index < 20; index++) {
                    let key = $data_user[index];
                    let $limit;

                    if (key['limit-uptime']!= undefined){
                        $limit = key['limit-uptime'].replace("h", " Jam");
                    }else if (key['limit-uptime']===undefined){
                        $limit = key.profile;
                    }
                    else{
                        $limit = key['limit-uptime'];
                    }
                    $data_voucher.push({
                        username: key.name,
                        password: key.password,
                        identity: identity,
                        limit: $limit
                    })
                    console.log($limit);
                }
            } else {
                for (let index = 0; index < $data_user.length; index++) {
                    let key = $data_user[index];
                    let $limit;
                    
                    if (key['limit-uptime']!= undefined){
                        $limit = key['limit-uptime'].replace("h", " Jam");
                    }
                    else if (key['limit-uptime']===undefined){
                        $limit = key.profile;
                    }
                    else{
                        $limit = key['limit-uptime'];
                    }
                    console.log($limit);
                    $data_voucher.push({
                        username: key.name,
                        password: key.password,
                        identity: identity,
                        limit: $limit
                    })
                }
            }

            this.data_user = $data_voucher;
        }
    },
    mounted() {
        this.load();
    },
})
</script>

</html>