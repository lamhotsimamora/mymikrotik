let $ip_service = new Vue({
    el: '#ip_service',
    data: {
        id_api: null,
        api_enabled: true,
        api_port: null,
        id_apissl: null,
        apissl_port: null,
        apissl_enabled: true,
        id_ftp: null,
        ftp_port: null,
        ftp_enabled: true,
        id_www: null,
        www_port: null,
        www_enabled: true,
        id_www: null,
        ssh_port: null,
        ssh_enabled: true,
        id_ssh: null,
        winbox_port: null,
        winbox_enabled: true,
        id_winbox: null,
        telnet_port: null,
        telnet_enabled: true,
        id_telnet: null,
        wwwssl_port: null,
        wwwssl_enabled: true,
        id_wwwssl: null,
        api_ssl_input_readonly: false,
        api_input_readonly: false,
        ftp_input_readonly: false,
        ssh_input_readonly: false,
        telnet_input_readonly: false,
        winbox_input_readonly: false,
        www_input_readonly: false,
        wwwssl_input_readonly: false
    },
    methods: {
        loadData: function() {
            jnet({
                url: URL_API_GET_IPSERVICE,
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

                    for (let index = 0; index < $obj.length; index++) {

                        const name = $obj[index].name;
                        const port = $obj[index].port;
                        const id = $obj[index]['.id'];
                        let disabled = $obj[index]['disabled'];

                        if (disabled === 'true') {
                            disabled = true;
                        } else {
                            disabled = false;
                        }

                        switch (name) {
                            case 'www':
                                this.www_port = port;
                                this.id_www = id;
                                this.wwwssl_enabled = disabled;
                                this.www_input_readonly = this.wwwssl_enabled ? true : false;
                                break;
                            case 'api-ssl':
                                this.apissl_port = port;
                                this.id_apissl = id;
                                this.apissl_enabled = disabled;
                                this.api_ssl_input_readonly = this.apissl_enabled ? true : false;
                                break;
                            case 'api':
                                this.api_port = port;
                                this.id_api = id;
                                this.api_enabled = disabled;
                                this.api_input_readonly = this.api_enabled ? true : false;
                                break;
                            case 'winbox':
                                this.winbox_port = port;
                                this.id_winbox = id;
                                this.winbox_enabled = disabled;
                                this.winbox_input_readonly = this.winbox_enabled ? true : false;
                                break;
                            case 'ftp':
                                this.ftp_port = port;
                                this.id_ftp = id;
                                this.ftp_enabled = disabled;
                                this.ftp_input_readonly = this.ftp_enabled ? true : false;
                                break;
                            case 'telnet':
                                this.telnet_port = port;
                                this.id_telnet = id;
                                this.telnet_enabled = disabled;
                                this.telnet_input_readonly = this.telnet_enabled ? true : false;
                                break;
                            case 'ssh':
                                this.ssh_port = port;
                                this.id_ssh = id;
                                this.ssh_enabled = disabled;
                                this.ssh_input_readonly = this.ssh_enabled ? true : false;
                                break;
                            case 'www-ssl':
                                this.wwwssl_port = port;
                                this.id_wwwssl = id;
                                this.wwwssl_enabled = disabled;
                                this.wwwssl_input_readonly = this.wwwssl_enabled ? true : false;
                                break;
                            default:
                                break;
                        }

                    }
                }
            });
        },
        update: function($id, $port) {
            if ($id) {

                if (this.api_port == null || this.api_port === '') {
                    this.$refs.api_port.focus();
                    return;
                }

                if (this.apissl_port == null || this.apissl_port === '') {
                    this.$refs.apissl_port.focus();
                    return;
                }


                if (this.www_port == null || this.www_port === '') {
                    this.$refs.www_port.focus();
                    return;
                }


                if (this.winbox_port == null || this.winbox_port === '') {
                    this.$refs.winbox_port.focus();
                    return;
                }


                if (this.telnet_port == null || this.telnet_port === '') {
                    this.$refs.telnet_port.focus();
                    return;
                }




                jnet({
                    url: URL_API_UPDATE_IPSERVICE,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _username: $username,
                        _password: $password,
                        _port: $port,
                        _ip_address: $ip_address,
                        _id_api: this.id_api,
                        _id_www: this.id_www,
                        _id_winbox: this.id_winbox,
                        _id_ftp: this.id_ftp,
                        _id_apissl: this.apissl,
                        _id_ssh: this.id_ssh,
                        _id_telnet: this.id_telnet,
                    }
                }).request($response => {
                    if ($response) {
                        let $obj = JSON.parse($response);
                        this.data_ipservice = $obj;
                    }
                });
            }
        }
    },
    mounted() {
        this.loadData();
    }
})