let $login = new Vue({
    el: '#loginbox',
    data: {
        username: null,
        password: null,
        text_or_password: 'password',
        text_button_show: 'Show password'
    },
    methods: {
        showPassword: function() {
            if (this.text_or_password === 'password') {
                this.text_or_password = 'text';
                this.text_button_show = 'Hide password';
            } else {
                this.text_or_password = 'password'
                this.text_button_show = 'Show password';
            }
        },
        enterLogin: function(e) {

            if (e.keyCode == 13) {
                this.login();
            }
        },
        login: function() {
            if (this.username == null || this.username === '') {
                this.$refs.username.focus();
                return;
            }

            if (this.password == null || this.password === '') {
                this.$refs.password.focus();
                return;
            }

            jnet({
                url: URL_API_LOGIN,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _username: this.username,
                    _password: this.password
                }
            }).request($response => {

                if ($response) {
                    let $obj = JSON.parse($response);

                    if ($obj) {
                        let $result = $obj.result;

                        if ($result == true) {
                            let $id_admin = $obj.id_admin;
                            Cookies.set('id_admin', $id_admin, { expires: 1 });
                            Cookies.set('username_', this.username, { expires: 1 });
                            window.location.href = URL_DASHBOARD;
                        } else {
                            Swal.fire({
                                title: 'Login Gagal !',
                                text: 'Silahkan coba lagi ! Username / Password Salah..',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                }
            })

        }
    }
})


if (Cookies.get('id_admin') == null || Cookies.get('id_admin') == undefined) {

} else {

    jnet({
        url: URL_API_CHECK_LOGIN,
        method: 'post',
        data: {
            _token: _TOKEN_,
            _id_admin: Cookies.get('id_admin')
        }
    }).request($response => {
        if ($response === 'T') {
            window.location.href = URL_DASHBOARD;
        }
    })
}