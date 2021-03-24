let $ipaddress = new Vue({
    el: '#ipaddress',
    data: {
        data_ipaddress: null
    },
    methods: {
        deleteData: function(id_ip) {
            if (id_ip == null) {
                return;
            }

            if (window.confirm("Yakin mau hapus data ?")) {
                jnet({
                    url: URL_API_IP_ADDRESS_DELETE,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _ip_address: $ip_address,
                        _username: $username,
                        _password: $password,
                        _id_ip: id_ip,
                        _port: $port
                    }
                }).request($response => {
                    if ($response) {
                        if ($response === 'T') {
                            this.loadData();
                            alert("IP address berhasil dihapus !");
                        } else {
                            alert("Gagal menghapus data");
                        }
                    }
                })
            }
        },
        loadData: function() {
            jnet({
                url: URL_API_ROUTER_IPADDRESS,
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
                        this.data_ipaddress = $obj;
                    } else {
                        this.data_ipaddress = null;
                    }
                }
            })
        }
    },
    mounted() {
        this.loadData();
    },
})

let $form_data = new Vue({
    el: '#modal_add',
    data: {
        data_interface: null,
        interface: null,
        ip_address: null
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
        save: function() {
            if (this.ip_address == null || this.naip_addressme === '') {
                this.$refs.ip_address.focus();
                return;
            }

            jnet({
                url: URL_API_IP_ADDRESS_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _interface: this.interface,
                    _ipaddress: this.ip_address,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $ipaddress.loadData();
                        this.nterface = null;
                        this.ip_address = null;
                        alert("IP Address berhasil ditambahkan");
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {
        this.loadInterface()
    },
})