String.prototype._replace = function(s, r) { return this.split(s).join(r) };



let $interface = new Vue({
    el: '#ipdns',
    data: {
        data_ipdns: null
    },
    methods: {
        loadData: function() {
            jnet({
                url: URL_API_ROUTER_IPDNS,
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
                        this.data_ipdns = $obj;
                    } else {
                        this.data_ipdns = null;
                    }
                }
            })
        },
        replaceToBr: function($data) {
            return $data._replace(',', '</br>');
        }
    },
    mounted() {
        this.loadData();
    },
})