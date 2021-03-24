let $profiles = new Vue({
    el: '#ppp-profiles',
    data: {
        data_profiles: null
    },
    methods: {
        loadData: function() {
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
                        this.data_profiles = $obj;
                    } else {
                        this.data_profiles = null;
                    }
                }
            })
        },
        removeData: function($id_profile) {
            if ($id_profile) {
                let r = confirm("Anda yakin mau hapus data ini ?");
                if (r == true) {
                    jnet({
                        url: URL_API_PPP_PROFILE_DELETE,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _ip_address: $ip_address,
                            _username: $username,
                            _password: $password,
                            _id: $id_profile,
                            _port: $port
                        }
                    }).request($response => {
                        if ($response === 'T') {
                            this.loadData();
                            alert('PPP Profile Berhasil Dihapus !');
                        } else {
                            alert('Gagal hapus data !');
                        }
                    })
                }
            }
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
        local: null,
        remote: null,
        data_local: [],
        data_remote: [],
        limit: null
    },
    methods: {
        loadDataIpPool: function() {
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
                        this.data_local = $obj;
                        this.data_remote = $obj;
                    } else {
                        this.data_local = null;
                        this.data_remote = null;
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
                url: URL_API_PPP_PROFILE_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name,
                    _local: this.local,
                    _remote: this.remote,
                    _limit: this.limit,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        this.name = null;
                        this.limit = null;
                        alert("PPP Profile berhasil ditambahkan");
                        $profiles.loadData()
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {
        this.loadDataIpPool()
    },
})