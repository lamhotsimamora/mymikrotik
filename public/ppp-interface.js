let $interface = new Vue({
    el: '#ppp-interface',
    data: {
        data_interfaces: null
    },
    methods: {
        loadData: function() {
            setInterval(() => {
                jnet({
                    url: URL_API_PPP_GET_INTERFACE,
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
                            this.data_interfaces = $obj;
                        } else {
                            this.data_interfaces = null;
                        }
                    }
                })
            }, 2000);
            
        }
    },
    mounted() {
        this.loadData()
    },
})