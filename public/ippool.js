let $ippool = new Vue({
    el: '#ippool',
    data: {
        data_ippool: null
    },
    methods: {
        loadData: function() {
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
                        this.data_ippool = $obj;
                    } else {
                        this.data_ippool = null;
                    }
                }
            })
        },
        removePool: function(id_pool) {
            if (id_pool) {
                let r = confirm("Anda yakin mau hapus data ini ?");
                if (r == true) {
                    jnet({
                        url: URL_API_ROUTER_IPPOOL_DELETE,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _ip_address: $ip_address,
                            _username: $username,
                            _password: $password,
                            _id_pool: id_pool,
                            _port: $port
                        }
                    }).request($response => {
                        if ($response === 'T') {
                            this.loadData();
                            alert('IP Pool Berhasil Dihapus !');
                        } else {
                            alert('Gagal hapus data !');
                        }
                    })
                }
            }
        }
    },
    mounted() {
        this.loadData();
    },
})

let $modal_add = new Vue({
    el: '#modal_add',
    data: {
        name: null,
        address: null,
        next_pool: null
    },
    methods: {
        save: function() {
            if (this.name == null || this.name === '') {
                this.$refs.name.focus();
                return;
            }

            if (this.address == null || this.address === '') {
                this.$refs.address.focus();
                return;
            }

            jnet({
                url: URL_API_IP_POOL_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name,
                    _address: this.address,
                    _next_pool: this.next_pool,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $ippool.loadData();
                        this.name = null;
                        this.address = null;
                        this.next_pool = null;
                        alert("IP Pool berhasil ditambahkan");
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    }
})