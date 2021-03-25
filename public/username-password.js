new Vue({
    el: '#username-password',
    data: {
        new_username: null,
        new_password: null,
        type_password: 'password'
    },
    methods: {
        showPassword: function() {
            if (this.type_password === 'password') {
                this.type_password = 'text';
            } else {
                this.type_password = 'password';
            }
        },
        update: function() {
            if (this.new_username == null || this.new_username === '') {
                this.$refs.new_username.focus();
                return;
            }
            if (this.new_password == null || this.new_password === '') {
                this.$refs.new_password.focus();
                return;
            }
            var r = confirm("Yakin password aplikasi ini mau diganti ?");
            if (r == true) {
                jnet({
                    url: URL_API_USERNAME_PASSWORD,
                    method: 'post',
                    data: {
                        _token: _TOKEN_,
                        _id_admin: Cookies.get('id_admin'),
                        _new_username: this.new_username,
                        _new_password: this.new_password
                    }
                }).request($response => {
                    if ($response === 'T') {
                        alert("Password Berhasil Diganti");
                    } else {
                        alert("Password Gagal Diganti");
                    }
                })
            }
        }
    },
})