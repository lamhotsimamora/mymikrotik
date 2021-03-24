let $bandwith = new Vue({
    el: '#bandwith',
    data: {
        data_bandwith: null
    },
    methods: {
        loadData: function() {
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

        },
        deleteData: function(id_bandwith = null) {
            if (id_bandwith) {
                let r = confirm("Yakin mau hapus data ini ?");

                if (r == true) {
                    jnet({
                        url: URL_API_BANDWITH_DELETE,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _id_bandwith: id_bandwith
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
        bandwith: null,
        price: null
    },
    methods: {
        save: function() {
            if (this.bandwith == null || this.bandwith === '') {
                this.$refs.bandwith.focus();
                return;
            }
            if (this.price == null || this.price === '') {
                this.$refs.price.focus();
                return;
            }
            jnet({
                url: URL_API_BANDWITH_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _bandwith: this.bandwith,
                    _price: this.price
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $bandwith.loadData();
                        alert("Data berhasil ditambahkan");
                        this.bandwith = null;
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    }
})