let $form_generate_user = new Vue({
    el: '#form_generate_user',
    data: {
        show_form: false,
        data_server: null,
        data_profile: null,
        time_limit: null,
        comment: null,
        servers: null,
        profile: null,
        length: 6,
        disabled_button: false,
        obj_server: null,
        rate_limit: null
    },
    methods: {
        rejectSpace: function() {
            try {
                this.comment = this.comment.trim();
            } catch (error) {

            }
        },
        add: function() {
            if (this.servers == null) {
                alert("Pilih Server Terlebih Dahulu !");
                return;
            }
            if (this.profile == null) {
                alert("Pilih Profile Terlebih Dahulu !");
                return;
            }

            if (this.time_limit == null || this.time_limit === '') {
                this.$refs.time_limit.focus();
                return;
            }
            if (this.comment == null || this.comment === '') {
                this.$refs.comment.focus();
                return;
            }
            if (this.length == null || this.length === '') {
                this.$refs.length.focus();
                return;
            }

            if (this.servers == null) {
                alert("Something is wrong !");
                return;
            }

            if (this.profile == null) {
                alert("Something is wrong !");
                return;
            }


            this.disabled_button = true;
            $$('btn_show_modal').click();

            jnet({
                url: URL_API_ROUTER_NEW_USER_VOUCHER,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _time_limit: this.time_limit,
                    _comment: this.comment,
                    _server: this.servers,
                    _profile: this.profile.name,
                    _length: this.length,
                    _port: $port
                }
            }).request($response => {
                this.disabled_button = false;
                if ($response === 'T') {
                    $data_hotspot_users.loadData();
                    alert("Voucher berhasil dibuat !");
                } else {
                    alert("Gagal membuat voucher");
                }
                $$('btn_close_modal').click();
            })

        },
        selectServer: function(e) {

        },
        selectProfile: function(data) {
            this.rate_limit = data;
        },
        loadDataServer: function() {
            this.data_server = null;

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
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        this.data_server = $obj;
                    } else {
                        this.data_server = null;
                    }
                }
            })
        },
        loadDataProfile: function() {
            this.data_profile = null;

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
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        this.data_profile = $obj;
                    } else {
                        this.data_profile = null;
                    }
                }
            })
        }
    },
    mounted() {
        this.loadDataServer();
        this.loadDataProfile();
        this.obj_server = $$('select_server');
    }
})


let $search_user_m = new Vue({
    el: '#search_tmp',
    data: {
        search_query: null,
        enabled: true
    },
    methods: {
        enterCari: function(e) {
            if (e.keyCode == 13) {
                this.cariData()
            }
        },
        cariData: function() {
            if (this.search_query == null || this.search_query === '') {
                this.$refs.search_query.focus();
                $data_hotspot_users.data_hotspot_users = $copy_data_hotspot_users;
                return;
            }

            const $query = this.search_query.toString();

            let $match = [];

            for (let index = 0; index < $data_hotspot_users.data_hotspot_users.length; index++) {
                const obj = $data_hotspot_users.data_hotspot_users[index];

                const name = obj.name.toString();

                if (name === $query) {
                    console.log("Name " + name)
                    $match.push(obj);
                }
            }
            $data_hotspot_users.data_hotspot_users = $match;
        }
    }
})