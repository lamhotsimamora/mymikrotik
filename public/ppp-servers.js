let $servers = new Vue({
    el: '#ppp-servers',
    data: {
        data_servers: null
    },
    methods: {
        deleteData: function($id) {
            if ($id == null) {
                return;
            }

            if (window.confirm("Yakin mau hapus data ?")) {
                jnet({
                    url: URL_API_PPP_SERVER_DELETE,
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
                            alert("PPP Server berhasil dihapus !");
                        } else {
                            alert("Gagal menghapus data");
                        }
                    }
                })
            }
        },
        loadData: function() {
            jnet({
                url: URL_API_PPP_GET_SERVERS,
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
                        this.data_servers = $obj;
                    } else {
                        this.data_servers = null;
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
        service_name: null,
        interface: null,
        profile: null,
        data_profile: [],
        data_interface: []
    },
    methods: {
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
        loadDataPPPProfile: function() {
            jnet({
                url: URL_API_PPP_GET_PROFILES,
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
                        this.data_profile = $obj;
                    } else {
                        this.data_profile = null;
                    }
                }
            })
        },
        save: function() {
            if (this.service_name == null || this.service_name === '') {
                this.$refs.service_name.focus();
                return;
            }


            jnet({
                url: URL_API_PPP_SERVER_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _service_name: this.service_name,
                    _profile: this.profile,
                    _interface: this.interface,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        this.service_name = null;
                        alert("PPP Server berhasil ditambahkan");
                        $servers.loadData()
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {
        this.loadDataPPPProfile();
        this.loadInterface();
    },
})