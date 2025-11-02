<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Voucher </title>
    <script src="<?= base_url('public/'); ?>js/js.cookie.min.js"></script>
    <script src="<?= base_url('public/'); ?>js/garuda.js"></script>
    <script src="<?= base_url('public/'); ?>js/vue.js"></script>
    <link href="<?= base_url('public/css/'); ?>font-google.css" rel="stylesheet" />
    <link rel="icon" href="<?= base_url('public/') ?>img/router.png" type="image/gif" sizes="16x16">

    <style>
        [v-cloak] {
            display: none;
        }

        body {
            font-family: 'Courier New', monospace;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* 🔹 Grid otomatis menyesuaikan lebar kertas */
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(8cm, 1fr));
            gap: 0.8cm;
            justify-content: center;
            padding: 1cm;
            box-sizing: border-box;
        }

        /* 🔹 Desain voucher besar */
        .voucher {
            background: linear-gradient(160deg, #22a6b3, #0984e3);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25);
            padding: 15px;
            color: #fff;
            height: 8.5cm;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            page-break-inside: avoid;
        }

        .voucher img {
            width: 70px;
            margin-bottom: 8px;
        }

        .voucher hr {
            border: none;
            border-top: 1px dashed rgba(255, 255, 255, 0.7);
            width: 80%;
            margin: 6px 0;
        }

        /* 🔹 Label dan nilai lebih besar */
        .label {
            font-size: 13pt;
            color: #ecf0f1;
            letter-spacing: 0.5px;
        }

        .value {
            font-size: 18pt;
            font-weight: bold;
            color: #130f40;
            background: #ecf0f1;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            margin-top: 4px;
        }

        .footer {
            font-size: 12pt;
            color: #f5f6fa;
            margin-top: 8px;
            font-weight: bold;
        }

        /* 🔹 Tampilan untuk print */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            @page {
                size: A4 portrait;
                margin: 0.8cm;
            }

            .container {
                grid-template-columns: repeat(auto-fit, minmax(8cm, 1fr));
                gap: 0.5cm;
                padding: 0;
                margin: 0;
            }

            .voucher {
                box-shadow: none;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div id="app" class="container" v-cloak>
        <div v-for="(data_user, index) in data_user" :key="index" class="voucher">
            <div>
                <img src="<?= base_url('public/') ?>img/logo.png" alt="logo">
                <hr>
                <div class="label">USERNAME</div>
                <div class="value">{{ data_user.username }}</div>
                <hr>
                <div class="label">PASSWORD</div>
                <div class="value">{{ data_user.password }}</div>
                <hr>
                <div class="label">LIMIT</div>
                <div class="value">{{ data_user.limit }}</div>
            </div>
            <div class="footer">{{ data_user.identity }}</div>
        </div>
    </div>

    <script>
        if (!localStorage.getItem('data_voucher_ready_to_print')) {
            window.location.href = URL_SERVER + 'admin/index';
        }

        _setTitle("Print Voucher "+Cookies.get('identity_mikrotik'));

        new Vue({
            el: '#app',
            data: {
                data_user: []
            },
            methods: {
                load() {
                    let dataLocal = JSON.parse(localStorage.getItem('data_voucher_ready_to_print'));
                    let identity = Cookies.get('identity_mikrotik') || "MikroTik Hotspot";
                    let vouchers = [];

                    dataLocal.slice(0, 50).forEach(key => {
                        let limit = "-";
                        if (key['limit-uptime']) {
                            limit = key['limit-uptime'].replace("h", " Jam");
                        } else if (key.profile) {
                            limit = key.profile;
                        }
                        vouchers.push({
                            username: key.name,
                            password: key.password,
                            limit: limit,
                            identity: identity
                        });
                    });

                    this.data_user = vouchers;
                }
            },
            mounted() {
                this.load();
            },
        });
    </script>
</body>
</html>
