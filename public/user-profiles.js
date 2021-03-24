let $loading = new Vue({
    el: '#loading',
    data: {
        show: true
    }
})


let $data_hotspot_users_profile = new Vue({
    el: '#data_hotspot_users_profile',
    data: {
        data_hotspot_users_profile: null,
        show: true
    },
    methods: {
        deleteData: function($id_user_profile) {
            if ($id_user_profile) {
                jnet({
                    url: URL_API_ROUTER_SERVER_USERS_PROFILE_DELETE,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _ip_address: $ip_address,
                        _username: $username,
                        _password: $password,
                        _id: $id_user_profile,
                        _port: $port
                    }
                }).request($response => {
                    if ($response === 'T') {
                        this.loadData();
                        alert("Data user profiles berhasil dihapus ");
                    } else {
                        alert("Gagal hapus data ");
                    }
                })
            }
        },
        loadData: function() {
            this.data_hotspot_users_profile = null;
            jnet({
                url: URL_API_ROUTER_SERVER_USERS_PROFILE_GET,
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
                        this.data_hotspot_users_profile = $obj;
                    } else {
                        this.data_hotspot_users_profile = null;
                    }
                }
            })
        }
    },
    mounted() {
        this.loadData();
    },
})


let $form_add_user_profiles = new Vue({
    el: '#form_add_user_profiles',
    data: {
        name_pool: null,
        rate_limit: null,
        day: null,
        data_ip_pool: null,
        ip_pool: null,
        show_form: true
    },
    methods: {
        selectIpPool: function(e) {
            console.table(e.target.value);
        },
        addData: function() {
            if (this.name_pool == null || this.name_pool === '') {
                this.$refs.name_pool.focus();
                return;
            }

            if (this.rate_limit == null || this.rate_limit === '') {
                this.$refs.rate_limit.focus();
                return;
            }
            if (this.ip_pool == null) {
                alert("Pilih IP Pool Terlebih Dahulu");
                return;
            }


            jnet({
                url: URL_API_ROUTER_ADD_USERS_PROFILE,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name_pool,
                    _pool: this.ip_pool,
                    _rate_limit: this.rate_limit,
                    _day: this.day,
                    _port: $port
                }
            }).request($response => {
                if ($response === 'T') {
                    alert("Data user profiles berhasil ditambahkan");
                    this.name_pool = null;
                    this.rate_limit = null;
                    this.day = null;
                    $data_hotspot_users_profile.loadData();
                } else {
                    alert("Gagal menambahkan data ip pool !");
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
        }
    },
    mounted() {
        this.loadIpPool();
    },
})