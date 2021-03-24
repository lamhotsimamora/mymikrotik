new Vue({
    el: '#wireless-interface',
    data: {
        name: null,
        radio_name: null,
        ssid: null,
        mode: null,
        frequency: null,
        band: null,
        channel_width: null,
        wireless_protocol: null,
        security_profile: null,
        interface_type: null,
        security_profiles_data: null,
        search_profile_password: null,
        show_form: true,
        country: null
    },
    methods: {
        loadSecurityProfiles: function() {
            jnet({
                url: URL_API_GET_Security_Profiles_Wireless,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _username: this.username,
                    _password: this.password,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _port: $port
                }
            }).request($response => {

                if ($response) {
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        let password = null;
                        for (let index = 0; index < $obj.length; index++) {
                            const element = $obj[index];

                            const name = element.name;

                            if (name === this.search_profile_password) {
                                password = element['wpa2-pre-shared-key'];
                                break;
                            }
                        }
                        notifSuccess(this.search_profile_password + ' : ' + password, 'WPA2 PSK / WPA PSK', true);
                    }
                }
            });
        },
        showNotif: function() {
            this.loadSecurityProfiles();
        },
        loadData: function() {
            jnet({
                url: URL_API_GET_WIRELESS_INTERFACE,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _username: this.username,
                    _password: this.password,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _port: $port
                }
            }).request($response => {

                if ($response) {
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        if ($obj.length == 0) {
                            this.show_form = false;
                            return;
                        }
                        $obj = $obj[0];

                        let $name = $obj['name'];
                        let $radio_name = $obj['radio-name'];
                        let $ssid = $obj['ssid'];
                        let $mode = $obj['mode'];
                        let $frequency = $obj['frequency'];
                        let $band = $obj['band'];
                        let $channel_width = $obj['channel-width'];
                        let $wireless_protocol = $obj['wireless-protocol'];
                        let $security_profile = $obj['security-profile'];
                        let $interface_type = $obj['interface-type'];
                        let $country = $obj['country'];

                        this.name = $name;
                        this.radio_name = $radio_name;
                        this.ssid = $ssid;
                        this.mode = $mode;
                        this.frequency = $frequency;
                        this.band = $band;
                        this.channel_width = $channel_width;
                        this.wireless_protocol = $wireless_protocol;
                        this.security_profile = $security_profile;
                        this.interface_type = $interface_type;
                        this.country = $country;
                        this.search_profile_password = $security_profile;
                    }
                }
            });
        }
    },
    mounted() {
        this.loadData();
    }
})