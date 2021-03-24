let $router = new Vue({
    el: '#router',
    data: {
        data_router: null,
        total_router: null,
        search_query: null,
        show_btn: false,
        notif_not_found: false,

    },
    methods: {

        enterCari: function(e) {
            if (e.keyCode == 13) {
                this.cariData()
            }
        },
        cariData: function() {
            this.notif_not_found = false;
            if (this.search_query != null && this.search_query !== '') {
                this.search_query = this.search_query.toLowerCase();
                jnet({
                    url: URL_ADMIN_SEARCH_ROUTER,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _id_admin: Cookies.get('id_admin'),
                        _query: this.search_query
                    }
                }).request($response => {
                    if ($response) {
                        if ($response === 'null') {
                            this.notif_not_found = true;
                            return;
                        }
                        let $obj = JSON.parse($response);

                        if ($obj) {
                            this.data_router = $obj;
                        }
                    }
                });
            } else {
                this.$refs.search_query.focus();
                this.loadData()
            }
        },
        editRouter($ip, $username, $password, $port, $id, $router_name) {
            $form_data.username = $username;
            $form_data.password = $password;
            $form_data.ip_address = $ip;
            $form_data.port_api = $port;
            $form_data.id_router = $id;
            $form_data.router_name = $router_name;
        },
        loadData: function() {

            jnet({
                url: URL_API_LOAD_DATA_ROUTER_NEW,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _id_admin: Cookies.get('id_admin')
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'EMPTY' || $response === '') {
                        this.data_router = null;
                        this.show_btn = false;
                        return;
                    }
                    let $obj = JSON.parse($response);
                    if ($obj.length > 0) {
                        this.show_btn = true;
                    }
                    this.data_router = $obj;
                    this.total_router = $obj.length;
                } else {
                    this.data_router = null;
                    this.show_btn = false;
                }
            })

        },
        connect: function($ip_address = null, $username = null, $password = null, $port = null, $id_router = null) {
            $$('btn_show_modal').click();
            jnet({
                url: URL_API_LOGIN_ROUTER,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _port: $port,
                    _id_router: $id_router
                }
            }).request($response => {
                if ($response == 'true') {

                    localStorage.setItem("sidebar_active", 'sidebar_dashboard');
                    window.location.href = URL_ROUTER_CONNECT + $id_router;
                } else {
                    $$('btn_close_modal').click();
                    Swal.fire({
                        title: 'Failed Connect To [' + $ip_address + ']',
                        text: 'Check the IP address/username/password/port api',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                }
            })
        },
        pingRouter: function($ip_address = null, $port_api) {
            if ($ip_address == null) {
                return;
            }
            if ($port_api == null) {
                $port_api = 8728;
            }
            $$('btn_show_modal').click();
            jnet({
                url: URL_API_PING_ROUTER,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _port: $port_api
                }
            }).request($response => {

                $$('btn_close_modal').click();
                if ($response) {

                    if ($response === 'T') {
                        Swal.fire({
                            title: 'Success',
                            text: "Ping " + $ip_address + " Success",
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                    } else {

                        Swal.fire({
                            title: 'Failed',
                            text: "Ping " + $ip_address + " Failed",
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        })
                    }
                }
            })
        },
        deleteRouter: function($id_router) {

            if ($id_router) {
                console.log($id_router);

                Swal.fire({
                    title: 'Yakin mau hapus data ini ?',
                    text: "Data Router Akan Dihapus",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        jnet({
                            url: URL_API_DELETE_ROUTER,
                            method: 'post',
                            data: {
                                _token: _TOKEN_,
                                _id_router: $id_router,
                                _id_admin: Cookies.get('id_admin')
                            }
                        }).request($response => {
                            if ($response) {

                                if ($response === 'T') {
                                    $router.loadData();
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Hapus Data Berhasil !',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: 'Hapus Data Gagal !',
                                        icon: 'warning',
                                        confirmButtonText: 'OK'
                                    })
                                }
                            }
                        })
                    }
                })
            }
        }
    },
    mounted() {
        this.loadData();
    }
})

let $form_data = new Vue({
    el: '#form_data',
    data: {
        router_name: null,
        ip_address: null,
        username: null,
        password: null,
        port_api: 8728,
        id_router: null,
        show_id_router: false,
        text_or_password: 'password'
    },
    methods: {
        showPassword: function() {
            if (this.text_or_password === 'password') {
                this.text_or_password = 'text'
            } else {
                this.text_or_password = 'password'
            }
        },
        enterSave: function(e) {
            if (e.keyCode == 13) {
                this.save()
            }
        },
        cancel: function() {
            this.router_name = null;
            this.ip_address = null;
            this.username = null;
            this.password = null;
            this.id_router = null;
            this.port_api = 8728;
        },
        isIp: function() {
            // let $filter = /^[0-9.]*$/gm;

            // $result = $filter.test(this.ip_address);
            // try {
            //     if (!$result) {
            //         this.ip_address = this.ip_address.substring(0, this.ip_address.length - 1);
            //     }
            // } catch (error) {
            //     console.log(error);
            // }

        },
        save: function() {


            if (this.router_name == null || this.router_name === '') {
                this.$refs.router_name.focus();
                return;
            }

            if (this.ip_address == null || this.ip_address === '') {
                this.$refs.ip_address.focus();
                return;
            }

            if (this.username == null || this.username === '') {
                this.$refs.username.focus();
                return;
            }

            if (this.port_api == null || this.port_api === '') {
                this.port_api = 8728;
                return;
            }


            // // save to database
            // if (this.id_router == null) {
            jnet({
                    url: URL_API_SAVE_ROUTER,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _router_name: this.router_name,
                        _ip_address: this.ip_address,
                        _username: this.username,
                        _password: this.password,
                        _id_admin: Cookies.get('id_admin'),
                        _port: this.port_api
                    }
                }).request($response => {
                    if ($response) {

                        if ($response === 'T') {
                            $router.loadData();
                            this.router_name = null;
                            this.ip_address = null;
                            this.username = null;
                            this.password = null;
                            this.id_router = null;
                            notifSuccess();
                        } else {
                            Swal.fire({
                                title: 'Failed',
                                text: 'Simpan Data Gagal !',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                })
                // } else {
                //     jnet({
                //         url: URL_API_UPDATE_ROUTER,
                //         method: 'post',
                //         data: {
                //             _token: _TOKEN_,
                //             _router_name: this.router_name,
                //             _ip_address: this.ip_address,
                //             _username: this.username,
                //             _password: this.password,
                //             _id_admin: Cookies.get('id_admin'),
                //             _port: this.port_api,
                //             _id_router: this.id_router
                //         }
                //     }).request($response => {
                //         if ($response) {

            //             if ($response === 'T') {
            //                 $router.loadData();
            //                 this.router_name = null;
            //                 this.ip_address = null;
            //                 this.username = null;
            //                 this.password = null;
            //                 this.id_router = null;
            //             } else {
            //                 Swal.fire({
            //                     title: 'Failed',
            //                     text: 'Simpan Data Gagal !',
            //                     icon: 'warning',
            //                     confirmButtonText: 'OK'
            //                 })
            //             }
            //         }
            //     })
            // }
        }
    },
})



function clearRouter() {
    let r = confirm("Yakin ingin hapus semua data router ?");

    if (r == true) {
        $$('btn_show_modal').click();
        jnet({
            url: URL_API_CLEAR_ROUTER_DATA_JSON,
            method: 'post',
            data: {
                _token: _TOKEN_,
                _id_admin: Cookies.get('id_admin')
            }
        }).request($re => {
            $router.loadData();
            $$('btn_close_modal').click();
        })
    }
}