let $data_hotspot_profiles = new Vue({
    el: '#data_hotspot_profiles',
    data: {
        data_hotspot_profiles: null,
        show: false
    },
    methods: {
        loadData: function() {
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

                    $loading.show = false;
                    if ($obj) {
                        this.data_hotspot_profiles = $obj;
                    } else {
                        this.data_hotspot_profiles = null;
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
        dns_name: null,
        data_htmldirectory: null,
        htmldirectory: null,
        hotspot_address: null
    },
    methods: {
        loadDirectory: function() {
            jnet({
                url: URL_API_FILE_DIRECTORY_GET,
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
                        this.data_htmldirectory = $obj;
                    } else {
                        this.data_htmldirectory = null;
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
        this.loadDirectory()
    },
})