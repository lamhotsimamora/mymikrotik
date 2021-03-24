let $jenis = new Vue({
    el: '#jenis',
    data: {
        data_jenis: null
    },
    methods: {
        loadData: function() {
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
        deleteData: function(id_jenis = null) {
            if (id_jenis) {
                let r = confirm("Yakin mau hapus data ini ?");

                if (r == true) {
                    jnet({
                        url: URL_API_JENIS_DELETE,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _id_jenis: id_jenis
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
        jenis: null
    },
    methods: {
        save: function() {
            if (this.jenis == null || this.jenis === '') {
                this.$refs.jenis.focus();
                return;
            }
            jnet({
                url: URL_API_JENIS_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _jenis: this.jenis
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $jenis.loadData();
                        alert("Data berhasil ditambahkan");
                        this.jenis = null;
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    }
})