let $useractives = new Vue({
    el: '#useractives',
    data: {
        data_users: null,
        loading: true
    },
    methods: {
        convertByte: function(bytes) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0) return 'n/a';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            if (i == 0) return bytes + ' ' + sizes[i];
            return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
        },
        loadData: function() {
            this.loading = true;
            jnet({
                url: URL_API_ROUTER_USER_ACTIVE_HOTSPOT,
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
                    if ($response === 'F') {
                        return;
                    }
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        this.loading = false;
                        this.data_users = $obj;
                        $$('txt_count_active').innerHTML = $obj.length;
                    } else {
                        this.data_users = null;
                    }
                }
            })
        }
    },
    mounted() {
        const $obj = this;
        setInterval(function() {
            $obj.loadData();
        }, 7000);
        $$('name_router').innerHTML = Cookies.get('identity_mikrotik')
    },
})