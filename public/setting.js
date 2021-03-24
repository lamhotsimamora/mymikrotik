new Vue({
    el: '#setting_form',
    data: {
        server: null
    },
    methods: {
        save: function() {
            if (this.server == null || this.server === '') {
                this.$refs.server.focus();
            }

            if (this.server.substring(this.server.length - 1, this.server.length) === '/') {

            } else {
                this.server = this.server + '/';
            }

            localStorage.setItem("_URL_SERVER_", this.server);
            alert("URL SERVER Berhasil Disimpan !");
        },
        loadURLServer: function() {
            this.server = localStorage.getItem('_URL_SERVER_');
        }
    },
    mounted() {
        this.loadURLServer();
    }
})