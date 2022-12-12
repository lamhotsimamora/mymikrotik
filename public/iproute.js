let $iproute = new Vue({
    el: '#iproute',
    data: {
        dst_address_1: null,
        gateway_1: null,
        data_iproute: null,
        gateway_status: null,
        distance: null,
        disabled: null,
        active: null
    },
    methods: {
        loadData: function() {
            setInterval(() => {
                jnet({
                    url: URL_API_ROUTER_IPROUTE,
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
    
                            let $dst_address_1 = $obj[0]['dst-address'];
                            let $gateway_1 = $obj[0]['gateway'];
                            let $gateway_status = $obj[0]['gateway-status'];
                            this.disabled = $obj[0]['disabled'];
                            this.active = $obj[0]['active'];
                            this.distance = $obj[0]['distance'];
    
                            this.dst_address_1 = $dst_address_1;
                            this.gateway_1 = $gateway_1;
    
                            $obj = $obj.slice(1, $obj.length);
    
                            this.data_iproute = $obj;
                            this.gateway_status = $gateway_status;
    
                        } else {
                            this.data_iproute = null;
                        }
                    }
                })  
            }, 2000);
           
        }
    },
    mounted() {
        this.loadData();
    },
})