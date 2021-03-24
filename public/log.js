new Vue({
    el: '#log',
    data: {
        data_log: null,
        total: 0
    },
    methods: {
        load_data: function() {
            jnet({
                url: URL_API_LOG,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _username: $username,
                    _password: $password,
                    _port: $port,
                    _ip_address: $ip_address
                }
            }).request($response => {
                if ($response) {
                    let $obj = JSON.parse($response);

                    $obj = $obj.reverse();

                    $remove = 0;
                    if ($obj.length >= 1000) {
                        $remove = 950;
                        this.data_log = $obj.splice(0, $obj.length - $remove);
                    } else {
                        this.data_log = $obj;
                    }
                    this.total = this.data_log.length;
                }
            });
        }
    },
    mounted() {
        this.load_data();
    }
})