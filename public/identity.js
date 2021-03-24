function loadIdentity() {
    jnet({
        url: URL_API_GET_ROUTER_IDENTITY,
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
            let obj = JSON.parse($response);

            let identity = obj[0].name;

            Cookies.set('identity_mikrotik', identity);
            document.title = "My Mikrotik { " + identity + " } ";


            if (typeof notifSuccess != "undefined") {
                notifSuccess('Router ' + identity, 'Mikrotik');
            }
        }
    })
}

loadIdentity();