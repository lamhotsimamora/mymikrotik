let $secrets = new Vue({
    el: '#ppp-secrets',
    data: {
        data_secrets: null
    },
    methods: {
        deleteData: function(id_secret) {
            if (id_secret) {
                let r = confirm("Anda yakin mau hapus data ini ?");
                if (r == true) {
                    jnet({
                        url: URL_API_PPP_SECRET_DELETE,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _ip_address: $ip_address,
                            _username: $username,
                            _password: $password,
                            _id_secret: id_secret,
                            _port: $port
                        }
                    }).request($response => {
                        if ($response === 'T') {
                            this.loadData();
                            alert('Data PPP Secret Berhasil Dihapus !');
                        } else {
                            alert('Gagal hapus data !');
                        }
                    })
                }
            }
        },
        loadData: function() {
            jnet({
                url: URL_API_PPP_GET_SECRETS,
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
                        this.data_secrets = $obj;
                    } else {
                        this.data_secrets = null;
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
        name: null,
        password: null,
        service: null,
        profile: null,
        data_service: [{
                data: 'any'
            },
            {
                data: 'async'
            },
            {
                data: 'l2tp'
            },
            {
                data: 'ovpn'
            },
            {
                data: 'pppoe'
            },
            {
                data: 'pptp'
            },
            {
                data: 'sstp'
            }
        ],
        data_profile: []
    },
    methods: {
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
            if (this.name == null || this.name === '') {
                this.$refs.name.focus();
                return;
            }

            if (this.password == null || this.password === '') {
                this.$refs.password.focus();
                return;
            }

            jnet({
                url: URL_API_PPP_SECRET_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name,
                    _password_ppp: this.password,
                    _profile: this.profile,
                    _service: this.service,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        this.name = null;
                        this.password = null;
                        alert("PPP Secret berhasil ditambahkan");
                        $secrets.loadData()
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {
        this.loadDataPPPProfile()
    },
})