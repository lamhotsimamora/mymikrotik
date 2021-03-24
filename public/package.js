new Vue({
    el: '#package',
    data: {
        data_package: null
    },
    methods: {
        loadData: function() {
            jnet({
                url: URL_API_PACKAGE,
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
                    this.data_package = $obj;
                }
            });
        }
    },
    mounted() {
        this.loadData();
    }
})