let $loading = new Vue({
    el: '#loading',
    data: {
        show: false
    }
})

let $comment = new Vue({
    el: '#select_comment',
    data: {
        comments: null,
        data_comments: null,
        jml_comment: null
    },
    methods: {
        refresh: function() {
            $data_hotspot_users.loadData();
        },
        loadDataByComment: function() {
            let $data = $data_original_user;
            $data_filter_user_by_comment = [];

            for (let index = 0; index < $data.length; index++) {
                // check comment
                let comment = $data[index]['comment'];

                if (comment === this.comments) {
                    $data_filter_user_by_comment.push($data[index]);
                }

            }
            $data_hotspot_users.data_hotspot_users = $data_filter_user_by_comment;
            this.jml_comment = $data_filter_user_by_comment.length;
        },
        printVoucher: function() {
            localStorage.setItem('data_voucher_ready_to_print', JSON.stringify($data_hotspot_users.data_hotspot_users));

            window.open(URL_SERVER + 'admin/print', '_blank');
        },
        printAll: function() {
            $data_hotspot_users.loadData(function() {
                localStorage.setItem('data_voucher_ready_to_print', JSON.stringify($data_hotspot_users.data_hotspot_users));

                window.open(URL_SERVER + 'admin/print', '_blank');
            });
        }
    },
    mounted() {

    }
})

let $btn_show_form = new Vue({
    el: '#btn_show_form',
    data: {
        show_button: true
    },
    methods: {
        showForm: function() {
            $form_generate_user.show_form = true;
            this.show_button = false;
        }
    }
})
let $copy_data_hotspot_users = null;
let $data_hotspot_users = new Vue({
    el: '#data_hotspot_users',
    data: {
        data_hotspot_users: null,
        show: true
    },
    methods: {
        convertByte: function(bytes) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0) return 'n/a';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            if (i == 0) return bytes + ' ' + sizes[i];
            return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
        },
        deleteData: function($id) {
            if ($id) {
                var r = confirm("Yakin ingin menghapus user ini ?");
                if (r == true) {
                    $loading.show = true;
                    jnet({
                        url: URL_API_DELETE_USER_VOUCHER,
                        method: 'post',
                        data: {
                            _token: _TOKEN_,
                            _ip_address: $ip_address,
                            _username: $username,
                            _password: $password,
                            _port: $port,
                            _id_user: $id
                        }
                    }).request($response => {
                        if ($response) {
                            $loading.show = false;
                            if ($response === 'T') {
                                this.loadData();
                                alert("User Berhasil Dihapus")
                            } else {
                                alert("User Gagal Dihapus")
                            }
                        }
                    });
                }
            }
        },
        loadData: function($callback = null) {
            $loading.show = true;
            this.jml_comment = null;
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
                    let $obj = JSON.parse($response);

                    $loading.show = false;
                    $search_user_m.enabled = false;
                    if ($obj) {
                        this.data_hotspot_users = $obj;
                        $copy_data_hotspot_users = this.data_hotspot_users;
                        $data_original_user = $obj;

                        let $data_comment_original = [];
                        let $data_comment_fix = [];

                        for (let index = 0; index < $obj.length; index++) {
                            let $comment = $obj[index]['comment'];

                            if ($comment != undefined) {
                                $data_comment_original.push($comment);
                            }
                        }
                        // filter comment check double data
                        for (let index = 0; index < $data_comment_original.length; index++) {

                            if ($data_comment_original[index] === 'counters and limits for trial users') {

                            } else if (!$data_comment_fix.includes($data_comment_original[index])) {
                                $data_comment_fix.push($data_comment_original[index])
                            }

                        }
                        $comment.data_comments = $data_comment_fix;
                    } else {
                        this.data_hotspot_users = null;
                        $copy_data_hotspot_users = this.data_hotspot_users;
                    }
                    if ($callback) {
                        $callback();
                    }
                }
            })
        }
    },
    mounted() {
        this.loadData(function() {
            try {
                if (find_user_auto) {
                    $search_user_m.search_query = find_user_auto;
                    localStorage.removeItem("find_user_from_page_user_active");
                    $search_user_m.cariData();
                }
            } catch (e) {
                console.log(e)
            }
        })
    }
})