new Vue({
    el: '#files',
    data: {
        data_files: null
    },
    methods: {
        load_data: function() {
            jnet({
                url: URL_API_FILES,
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
                    this.data_files = $obj;
                }
            });
        },
        convertByte: function(bytes) {
            if (bytes === undefined) {
                return;
            }
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0) return 'n/a';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            if (i == 0) return bytes + ' ' + sizes[i];
            return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i] + " | ";
        }
    },
    mounted() {
        this.load_data();
    }
})