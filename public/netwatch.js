new Vue({
    el: '#netwatch',
    data: {
        data_netwatch: null
    },
    methods: {
        load_data: function() {
            setInterval(() => {
                jnet({
                    url: URL_API_NETWATCH,
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
                        // this.data_netwatch = $obj;
    
                        let $new_data = [];
                        $obj.forEach(element => {
    
                            let host = element.host;
                            let comment = element.comment;
                            let status = element.status;
                            let style = '';
                            if (status === 'up') {
                                style = 'alert alert-success';
                            } else if (status === 'down') {
                                style = 'alert alert-danger';
                            }
    
                            $new_data.push({
                                host: host,
                                comment: comment,
                                status: status,
                                style: style
                            });
                        });
                        this.data_netwatch = $new_data;
                    }
                });
            }, 2000);
            
        }
    },
    mounted() {
        this.load_data();
    }
})