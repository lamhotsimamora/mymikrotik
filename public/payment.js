let $payment = new Vue({
    el: '#payment',
    data: {
        data_payment: null
    },
    methods: {
        loadData: function() {
            jnet({
                url: URL_API_LOAD_DATA_PAYMENT,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _id_admin: Cookies.get('id_admin')
                }
            }).request($response => {
                if ($response) {
                    let $obj = JSON.parse($response);
                    if ($obj) {
                        this.data_payment = $obj;
                    }
                }
            })

        },
        deleteData: function(id_payment = null) {
            if (id_payment) {
                let r = confirm("Yakin mau hapus data ini ?");

                if (r == true) {
                    jnet({
                        url: URL_API_PAYMENT_DELETE,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _id_payment: id_payment
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
        client: null,
        data_client: null,
        jml_pay: null,
        tgl_bayar: null
    },
    methods: {
        selectBandwith: function() {
            this.jml_pay = this.client.price;
        },
        loadClient: function() {
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
        save: function() {
            if (this.jml_pay == null || this.jml_pay === '') {
                this.$refs.jml_pay.focus();
                return;
            }
            jnet({
                url: URL_API_PAYMENT_ADD,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _jml_pay: this.jml_pay,
                    _tgl_bayar: this.tgl_bayar,
                    _id_client: this.client.id
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'T') {
                        $payment.loadData();
                        alert("Data berhasil ditambahkan");
                        this.jml_pay = null;
                    } else {
                        alert("Gagal tambah data");
                    }
                }
            })
        }
    },
    mounted() {
        this.loadClient();
    },
})