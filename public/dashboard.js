jnet({
    url: URL_API_LOGIN_ROUTER,
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
        if ($response == 'true') {
            console.log("Router Connected")
        } else {
            Swal.fire({
                title: 'Failed to connect !',
                text: 'Check your IP Address or username or password or api services',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            window.location.href = "";
        }
    }
})


$count_data = new Vue({
    el: '#load_data',
    data: {
        count_user_hotspot_active: 0,
        count_all_user_hotspot: 0,
        uptime: 0
    },
    methods: {
        loadDataAllUser: function() {
            jnet({
                url: URL_API_ROUTER_SERVER_USERS,
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
                        let $count = $obj.length;

                        this.count_all_user_hotspot = $count;
                    } else {
                        this.count_all_user_hotspot = 0;
                    }
                }
            })
        },
        loadDataActiveUser() {
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
                    if ($response === 'INPUT IS EMPTY') {
                        console.log("Upzzz Something Is Wrong, Input Is Empty")
                        return;
                    }
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        let $count = $obj.length;

                        this.count_user_hotspot_active = $count;
                    } else {
                        this.count_user_hotspot_active = null;
                    }
                }
            })
        }
    },
    mounted() {
        this.loadDataAllUser();
        this.loadDataActiveUser();
    }
})