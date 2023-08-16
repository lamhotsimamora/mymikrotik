let $client = new Vue({
    el: '#client',
    data: {
        data_client: null,
        search: null
    },
    methods: {
        enterSearch: function(e) {
            if (e.keyCode == 13) {
                this.cariData()
            }
        },
        cariData: function() {
            if (this.search == null || this.search === '') {
                this.$refs.search.focus();
                return;
            }

            jnet({
                url: URL_API_SEARCH_CLIENT,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _id_admin: Cookies.get('id_admin'),
                    _query: this.search
                }
            }).request($response => {
                if ($response) {
                    let $obj = JSON.parse($response);
                    if ($obj) {
                        this.data_client = $obj;
                    }
                }
            })
        },
        goToBandwith: function() {
            window.location.href = URL_SERVER + "admin/client/bandwith";
        },
        goToPayment: function() {
            window.location.href = URL_SERVER + "admin/client/payment";
        },
        loadData: function() {
            jnet({
                url: URL_API_LOAD_DATA_CLIENT,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _id_admin: Cookies.get('id_admin')
                }
            }).request($response => {
                if ($response) {
                    let $obj = JSON.parse($response);
                    if ($obj) {
                        this.data_client = $obj;
                    }
                }
            })
        },
        deleteData: function(id_client = null) {
            if (id_client) {
                let r = confirm("Yakin mau hapus data ini ?");

                if (r == true) {
                    jnet({
                        url: URL_API_USER_DELETE,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _id_client: id_client
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
        }
    },
    mounted() {
        this.loadData();
    }
})

$modal_add = new Vue({
    el: '#modal_add',
    data: {
        nama: null,
        id_jenis: null,
        jenis: null,
        data_jenis: null,
        tgl_pasang: null,
        bandwith: null,
        data_bandwith: null
    },
    methods: {
        save: function() {
            if (this.nama == null || this.nama === '') {
                this.$refs.nama.focus();
                return;
            }

            if (this.tgl_pasang == null || this.tgl_pasang === '') {
                this.$refs.tgl_pasang.focus();
                return;
            }


            jnet({
                url: URL_API_CLIENT_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _nama: this.nama,
                    _id_jenis: this.jenis,
                    _tgl_pasang: this.tgl_pasang,
                    _id_bandwith: this.bandwith
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $client.loadData();
                        alert("Data berhasil ditambahkan");
                        this.nama = null;

                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        },
        loadJenis: function() {
            jnet({
                url: URL_API_LOAD_DATA_JENIS,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _id_admin: Cookies.get('id_admin')
                }
            }).request($response => {
                if ($response) {
                    let $obj = JSON.parse($response);
                    if ($obj) {
                        this.data_jenis = $obj;
                    }
                }
            })

        },
        loadBandwith: function() {
            jnet({
                url: URL_API_LOAD_DATA_BANDWITH,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _id_admin: Cookies.get('id_admin')
                }
            }).request($response => {
                if ($response) {
                    let $obj = JSON.parse($response);
                    if ($obj) {
                        this.data_bandwith = $obj;
                    }
                }
            })

        }
    },
    mounted() {
        this.loadJenis();
        this.loadBandwith();
    }
})