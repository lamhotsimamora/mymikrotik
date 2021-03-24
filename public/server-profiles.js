let $data_hotspot_profiles = new Vue({
    el: '#data_hotspot_profiles',
    data: {
        data_hotspot_profiles: null,
        show: false
    },
    methods: {
        deleteData: function($id) {
            if ($id == null) {
                return;
            }

            if (window.confirm("Yakin mau hapus data ?")) {
                jnet({
                    url: URL_API_HOTSPOT_SERVER_PROFILE_DELETE,
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
                            alert("Data hotspot server profile berhasil dihapus !");
                        } else {
                            alert("Gagal menghapus data");
                        }
                    }
                })
            }
        },
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
                    try {
                        let $obj = JSON.parse($response);

                        $loading.show = false;
                        if ($obj) {
                            this.data_hotspot_profiles = $obj;
                        } else {
                            this.data_hotspot_profiles = null;
                        }
                    } catch (error) {
                        console.log(error)
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
                    try {
                        let $obj = JSON.parse($response);

                        let $directory_filter = [];
                        let index_dir = 0;
                        for (let index = 0; index < $obj.length; index++) {
                            const type = $obj[index].type;

                            if (type === 'directory') {
                                $directory_filter[index_dir] = $obj[index];
                                index_dir++;
                            }
                        }

                        if ($obj) {
                            this.data_htmldirectory = $directory_filter;
                        } else {
                            this.data_htmldirectory = null;
                        }
                    } catch (error) {
                        console.log(error)
                    }
                }
            })
        },
        save: function() {
            if (this.name == null || this.name === '') {
                this.$refs.name.focus();
                return;
            }

            if (this.hotspot_address == null || this.hotspot_address === '') {
                this.$refs.hotspot_address.focus();
                return;
            }

            if (this.name == null || this.dns_name === '') {
                this.$refs.dns_name.focus();
                return;
            }

            jnet({
                url: URL_API_HOTSPOT_SERVER_PROFILE_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name,
                    _address_hotspot: this.hotspot_address,
                    _dns: this.dns_name,
                    _htmldir: this.htmldirectory,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $data_hotspot_profiles.loadData();
                        this.name = null;
                        this.hotspot_address = null;
                        this.dns_name = null;
                        alert("Hotspot SErver Profile berhasil ditambahkan");
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