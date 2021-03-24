let $id_interface_selected = null;
let $interface = new Vue({
    el: '#interface',
    data: {
        data_interface: null
    },
    methods: {
        sendId: function($id_interface, $name) {
            $id_interface_selected = $id_interface;

            $modal_interface.name = $name;
        },
        checkEnableDisable: function($bool) {
            if ($bool === undefined) {
                this.show_btn_enable = false;
                return;
            }
            this.show_btn_enable = true;
            return ($bool === 'true') ? `<strong style="color: #00b894">Enabled</strong>` :
                `<strong style="color: #d63031">Disabled</strong>`;
        },
        enabledDisabled: function($disable = null, $id = null) {
            if ($id == null) {
                return;
            }
            $text = 'disable';
            $URL = URL_API_DISABLE_INTERFACE;
            if ($disable === 'true') {
                $text = 'enable';
                $URL = URL_API_ENABLE_INTERFACE;
            }
            if ($id == null) {
                return;
            }
            if ($disable) {
                var r = confirm("Data interface ini akan di " + $text + " ?");
                if (r == true) {
                    jnet({
                        url: $URL,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _ip_address: $ip_address,
                            _username: $username,
                            _password: $password,
                            _port: $port,
                            _id: $id
                        }
                    }).request($response => {
                        if ($response) {
                            if ($response === 'T') {
                                this.loadData();
                                alert("Data berhasil di " + $text + " !");
                            } else {
                                alert("Data gagal di " + $text + " !");
                            }
                        }
                    })
                }
            }
        },
        checkEnableDisableName: function($name, $bool) {

            if ($bool === undefined) {
                return;
            }
            if ($bool === 'true') {
                return `${$name}`;
            } else {
                return `${$name}`;
            }
        },
        loadData: function() {

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
        convertByte: function(bytes) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0) return 'n/a';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            if (i == 0) return bytes + ' ' + sizes[i];
            return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
        },
        checkEnableDisableComment: function($comment, $bool) {
            if ($bool === undefined) {
                return;
            }

            if ($bool === 'true') {
                return `<del>${$comment}</del>`;
            } else {
                return `<strong>${$comment}</strong>`;
            }
        },
        templateEnabled: function($bool) {
            if ($bool === undefined) {
                return;
            }
            if ($bool === 'true') {
                return `<span class="label label-important">false</span>`;
            } else {
                return `<span class="label label-success">true</span>`;
            }
        }
    },
    mounted() {
        this.loadData();
    },
})




let $modal_interface = new Vue({
    el: '#modal_interface',
    data: {
        name: null
    },
    methods: {

        save: function() {
            if (this.name == null || this.name === '') {
                this.$refs.name.focus();
                return;
            }

            jnet({
                url: URL_API_INTERFACE_NAME_CHANGE,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name,
                    _number: $id_interface_selected,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        this.name = null;
                        alert("Nama interface berhasil diubah");
                        $interface.loadData()
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {},
})