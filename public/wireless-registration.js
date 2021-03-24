new Vue({
    el: '#wireless-registration',
    data: {
        data_wireless_registration: null,
        show_table: true
    },
    methods: {
        reconnect: function() {
            $$('btn_show_modal').click();
            for (let index = 0; index < this.data_wireless_registration.length; index++) {
                const element = this.data_wireless_registration[index];

                const $id = element['.id'];

                if ($id || $id != undefined || $id !== null) {
                    this.reConnectWireless($id);
                }
            }

            this.loadData(function() {
                $$('btn_close_modal').click();
            });
        },
        reConnectWireless: function($id) {
            jnet({
                url: URL_API_RECONNECT_WIRELESS_REGISTRATION,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _username: $username,
                    _password: $password,
                    _ip_address: $ip_address,
                    _port: $port,
                    _id: $id
                }
            }).request($r => {});
        },
        loadData: function($callback = null) {
            jnet({
                url: URL_API_GET_WIRELESS_REGISTRATION,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _username: $username,
                    _password: $password,
                    _ip_address: $ip_address,
                    _port: $port
                }
            }).request($response => {

                if ($response) {
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        if ($obj.length == 0) {
                            this.show_table = false;
                            return;
                        }
                        this.data_wireless_registration = $obj;

                        if ($callback != null) {
                            $callback();
                        }
                    }
                }
            });
        }
    },
    mounted() {
        this.loadData();
    }
})