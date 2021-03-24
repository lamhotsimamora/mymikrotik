let $ipfirewall = new Vue({
    el: '#ipfirewall',
    data: {
        data_ipfirewall: null,
        show_btn_enable: true
    },
    methods: {
        checkEnableDisableComment: function($comment, $bool) {
            if ($comment === undefined) {
                return '';
            }
            if ($bool === undefined) {
                return '';
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
        },
        checkEnableDisable: function($bool) {
            if ($bool === undefined) {
                this.show_btn_enable = false;
                return `<strong style="color: #d63031">Disabled</strong>`;
            }

            this.show_btn_enable = true;
            return ($bool === 'true') ? `<strong style="color: #00b894">Enabled</strong>` :
                `<strong style="color: #d63031">Disabled</strong>`;
        },
        deleteFirewall: function($id) {
            if ($id) {
                var r = confirm("Yakin data ini ingin dihapus ?");
                if (r == true) {
                    jnet({
                        url: URL_API_DELETE_IP_FIREWALL,
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
                                alert("Data berhasil dihapus !");
                            } else {
                                alert('Data gagal dihapus !');
                            }
                        }
                    })
                }
            }
        },
        enabledDisabled: function($disable = null, $id = null) {
            $text = 'disable';
            $URL = URL_API_DISABLE_IP_FIREWALL;
            if ($disable === 'true') {
                $text = 'enable';
                $URL = URL_API_ENABLE_IP_FIREWALL;
            }
            if ($id == null) {
                return;
            }
            if ($disable) {
                var r = confirm("Data firewall ini akan di " + $text + " ?");
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
        loadData: function() {
            jnet({
                url: URL_API_ROUTER_IPFIREWALL,
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
                        this.data_ipfirewall = $obj;

                    } else {
                        this.data_ipfirewall = null;
                    }
                }
            })
        }
    },
    mounted() {
        this.loadData();
    },
});


let $modal_add = new Vue({
    el: '#modal_add',
    data: {
        chain: null,
        src_address: null,
        action: null,
        data_action: [
            { type: 'accept' },
            { type: 'add dst to address list' },
            { type: 'add src to address list' },
            { type: 'dst-nat' },
            { type: 'jump' },
            { type: 'log' },
            { type: 'masquerade' },
            { type: 'netmap' },
            { type: 'passthrough' },
            { type: 'redirect' },
            { type: 'return' },
            { type: 'same' },
            { type: 'srcnat' }
        ],
        data_chain: [
            { type: 'dstnat' }, { type: 'srcnat' }
        ]
    },
    methods: {
        save: function() {
            if (this.src_address == null || this.src_address === '') {
                this.$refs.src_address.focus();
                return;
            }

            jnet({
                url: URL_API_IP_FIREWALL_NAT_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _src: this.src_address,
                    _chain: this.chain,
                    _action: this.action,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        this.src_address = null;
                        alert("IP Firewall Nat berhasil ditambahkan");
                        $ipfirewall.loadData()
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    }
})