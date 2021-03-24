let $data_hotspot_server = new Vue({
    el: '#data_hotspot_server',
    data: {
        data_hotspot_server: null,
        show: true
    },
    methods: {
        deleteData: function($id) {
            if ($id == null) {
                return;
            }

            if (window.confirm("Yakin mau hapus data ?")) {
                jnet({
                    url: URL_API_HOTSPOT_SERVER_DELETE,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _ip_address: $ip_address,
                        _username: $username,
                        _password: $password,
                        _id: $id,
                        _port: $port
                    }
                }).request($response => {
                    if ($response) {
                        if ($response === 'T') {
                            this.loadData();
                            alert("Data Hotspot Server berhasil dihapus !");
                        } else {
                            alert("Gagal menghapus data");
                        }
                    }
                })
            }
        },
        loadData: function() {
            jnet({
                url: URL_API_ROUTER_SERVER_HOTSPOT,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'INPUT IS EMPTY') {
                        console.log("Upzzz Something Is Wrong, Input Is Empty")
                        return;
                    }
                    let $obj = JSON.parse($response);

                    $loading.show = false;
                    if ($obj) {
                        this.data_hotspot_server = $obj;
                        console.log("Load Data Server Hotspot")
                    } else {
                        this.data_hotspot_server = null;
                    }
                }
            })
        }
    },
    mounted() {
        this.loadData()
    },
})



let $form_data = new Vue({
    el: '#modal_add',
    data: {
        data_interface: null,
        interface: null,
        name: null,
        data_ip_pool: null,
        ippool: null,
        data_serverprofile: null,
        serverprofile: null,
        idle_timeout: '00:05:00'
    },
    methods: {
        loadServerProfiles: function() {
            this.data_serverprofile = null;
            jnet({
                url: URL_API_ROUTER_SERVER_PROFILES,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'INPUT IS EMPTY') {
                        console.log("Upzzz Something Is Wrong, Input Is Empty")
                        return;
                    }
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        this.data_serverprofile = $obj;
                    } else {
                        this.data_serverprofile = null;
                    }
                }
            })
        },
        loadIpPool: function() {
            this.data_ip_pool = null;
            jnet({
                url: URL_API_ROUTER_IPPOOL_GET,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'INPUT IS EMPTY') {
                        console.log("Upzzz Something Is Wrong, Input Is Empty")
                        return;
                    }
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        this.data_ip_pool = $obj;
                    } else {
                        this.data_ip_pool = null;
                    }
                }
            })
        },
        loadInterface: function() {
            jnet({
                url: URL_API_ROUTER_INTERFACE,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'INPUT IS EMPTY') {
                        console.log("Upzzz Something Is Wrong, Input Is Empty")
                        return;
                    }
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        this.data_interface = $obj;
                    } else {
                        this.data_interface = null;
                    }
                }
            })
        },
        save: function() {
            if (this.name == null || this.name === '') {
                this.$refs.name.focus();
                return;
            }

            jnet({
                url: URL_API_HOTSPOT_SERVER_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name,
                    _interface: this.interface,
                    _ippool: this.ippool,
                    _timeout: this.idle_timeout,
                    _profile: this.serverprofile,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $data_hotspot_server.loadData();
                        this.name = null;
                        alert("Hotspot Server berhasil ditambahkan");
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {
        this.loadInterface();
        this.loadIpPool();
        this.loadServerProfiles();
    },
})