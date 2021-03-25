let $queues = new Vue({
    el: '#queues',
    data: {
        data_queues: null
    },
    methods: {
        loadData: function() {
            jnet({
                url: URL_API_ROUTER_USER_QUEUE_HOTSPOT,
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
                    let $obj_fix = [];
                    if ($response) {
                        let $obj = JSON.parse($response);
                        console.log($obj);

                        for (let index = 0; index < $obj.length; index++) {
                            const objj = $obj[index];

                            const name = objj['name'];
                            const id = objj['.id'];
                            const target = objj['target'];
                            let max_limit = objj['max-limit'];
                            const priority = objj['priority'];
                            const bytes = objj['bytes'];
                            const dynamic = objj['dynamic'];
                           
                            
                           if (max_limit==='0/0'){
                               max_limit = 'unlimited/unlimited';

                                $obj_fix.push({
                                    ".id" : id,
                                    name : name,
                                    target : target,
                                    'max-limit' : max_limit,
                                    priority : priority,
                                    bytes : bytes,
                                    dynamic : dynamic
                                })
                           }else{
                               
                                const max_limit_length = max_limit.length;
                                const find_garis_miring=  max_limit.search("/");

                                const find_only_upload_zero = max_limit.substring(find_garis_miring, 0);
                                let $upload = 0;

                                if (find_only_upload_zero==='0'){
                                    $upload = 'unlimited';
                                }else{
                                    $upload = find_only_upload_zero;
                                }

                                let $download = 0;

                                const find_only_download_zero = max_limit.substring(find_garis_miring+1, max_limit_length);
                               
                                if (find_only_download_zero==='0'){
                                    $download = 'unlimited';
                                }else{
                                    $download = find_only_download_zero;
                                }

                                $max_limit = $upload+"/"+$download;
                                
                                $obj_fix.push({
                                    ".id" : id,
                                    name : name,
                                    target : target,
                                    'max-limit' : max_limit,
                                    priority : priority,
                                    bytes : bytes,
                                    dynamic : dynamic
                                })
                           }
                           
                        }
                       
                        if ($obj) {
                            this.data_queues = $obj_fix;
                        } else {
                            this.data_queues = null;
                        }
                    }

                }
            })
        },
        resultByte: function(bytes) {
          
            console.log(bytes);
            if (bytes==='unlimited/unlimited'){
                return bytes;
            }


            var index = bytes.search("/");

            let a = bytes.substring(0, index);

            a = convertByte(a);

            let b = bytes.substring(index + 1, bytes.length);

            b = convertByte(b);

            return a + '/' + b;
        },
        deleteData: function(id_queues = false) {
            if (id_queues == false) {
                return;
            }
            let r = confirm("Yakin mau hapus data ini ?");

            if (r == true) {

                jnet({
                    url: URL_API_QUEUES_DELETE,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _id_queues: id_queues,
                        _token: _TOKEN_,
                        _ip_address: $ip_address,
                        _username: $username,
                        _password: $password,
                        _port: $port
                    }
                }).request($response => {
                    if ($response === 'T') {
                        this.loadData();
                        alert("Data berhasil dihapus");
                    } else {
                        alert("Gagal menghapus data");
                    }
                });
            }
        }
    },
    mounted() {
        this.loadData();
    },
})

const $data_speed = [

    { speed: 'unlimited' },
    { speed: '64k' },
    { speed: '128k' },
    { speed: '256k' },
    { speed: '384k' },
    { speed: '512k' },
    { speed: '768k' },
    { speed: '1M' },
    { speed: '2M' },
    { speed: '3M' },
    { speed: '4M' },
    { speed: '5M' },
    { speed: '10M' },
]


let $form_data = new Vue({
    el: '#modal_add',
    data: {
        name: null,
        target: null,
        upload: null,
        download: null,
        data_download: $data_speed,
        data_upload: $data_speed
    },
    methods: {

        save: function() {
            if (this.name == null || this.name === '') {
                this.$refs.name.focus();
                return;
            }

            if (this.target == null || this.target === '') {
                this.$refs.target.focus();
                return;
            }

            jnet({
                url: URL_API_QUEUES_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _name: this.name,
                    _target: this.target,
                    _upload: this.upload,
                    _download: this.download,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        this.name = null;
                        this.target = null;
                        alert("Queues berhasil ditambahkan");
                        $queues.loadData();
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {},
})