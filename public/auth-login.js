if (Cookies.get('id_admin') == null || Cookies.get('id_admin') == undefined) {
    window.location.href = URL_LOGIN;
} else {
    jnet({
        url: URL_API_CHECK_LOGIN,
        method: 'post',
        data: {
            _token: _TOKEN_,
            _id_admin: Cookies.get('id_admin')
        }
    }).request($response => {
        if ($response === 'F') {
            Cookies.remove('id_admin');
            window.location.href = URL_LOGIN;
        } else if ($response === 'T') {
            console.log("Login Success");
        } else {
            Cookies.remove('id_admin');
            window.location.href = URL_LOGIN;
        }
    })
}