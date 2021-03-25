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
    <script src="<?= base_url('public/'); ?>js/garuda.js"></script>
    <link href="<?= base_url('public/css/'); ?>font-google.css" rel="stylesheet" />
    <link rel="icon" href="<?= base_url('public/') ?>img/router.png" type="image/gif" sizes="16x16">
    <style>
    [v-cloak] {
        display: none;
    }

    .container {
        display: grid;
        width: 10px;
        grid-template-columns: auto auto auto auto  auto auto  auto auto auto; 
        grid-template-rows: auto auto auto auto auto auto auto ;
    }

    .voucher {
        width: 120px;
        height: 130px;
        background:#34495e;
        position: relative;
        border: 1px solid grey;
        margin: 1px 2px 5px 5px;
    }

    .small {
        font-size: 3;
        font-family: 'Times New Roman', Courier, monospace;
        color: #ecf0f1;
    }

    .big {
        font-size: 5;
        font-family: 'Times New Roman', Courier, monospace;
        color: #3498db;
    }

    .verrysmall{
        font-size: 1;
        font-family: 'Times New Roman', Courier, monospace;
        color: #ecf0f1;
    }
    </style>
</head>

<body><br>

    <div id="app" class="container" v-cloak>
        <div v-for="(data_user) in data_user">
            <div class="voucher"> <br>
                <!-- <img class="img" src="<?= base_url('public/') ?>img/logo.png" alt="">
                <hr> -->
                <center class="small"><strong>Username</strong></center>
                <center class="big"><strong>{{ data_user.username }}</strong> </center>
               
                <center class="small"><strong>Password</strong></center>
                <center class="big"><strong>{{ data_user.password }}</strong></center> <hr>
               
                <center class="verrysmall">Limit : {{data_user['limit']}} <br>
                    
            </div>
        </div>

        <div id="template_enter">
            
        </div>
    </div>
   
</body>
<script>

    function htmlEnter(){
        return '<br><br>'
    }
    
if (!localStorage.getItem('data_voucher_ready_to_print')) {
    window.location.href = URL_SERVER + 'admin/index';
}
let $content_to_print =  new Vue({
    el: '#app',
    data: {
        data_user: null,
        template_enter : false
    },
    methods: {
        load: function() {
            let $data_user = JSON.parse(localStorage.getItem('data_voucher_ready_to_print'));
            let identity = Cookies.get('identity_mikrotik');

            // get all data voucher and add identity
            let $data_voucher = [];
            let length_voucher = $data_user.length;


            const $max_number_print = 53;

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
                    $data_voucher.push({
                        username: key.name,
                        password: key.password,
                        limit: $limit
                    })

                    if (index==$max_number_print){
                       Garuda('template_enter').setHtml(htmlEnter());
                      // break;
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