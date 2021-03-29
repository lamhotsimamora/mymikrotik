<div id="search">
    <input ref="query" v-model="query" type="text" @keypress="enterSearch($event)" placeholder="Search" />
    <button @click="search" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>

<script>

let $search_menu = new Vue({
    el: '#search',
    data: {
        query: null
    },
    methods: {
        enterSearch: function(e) {
            if (e.keyCode == 13) {
                this.search()
            }
        },
        search: function() {
            if (this.query == null || this.query === '') {
                this.$refs.query.focus();
                return;
            }
            console.log(this.query);
            this.directTo();
        },
        goTo: function($page = '') {
           const URL = _URL_PAGE_ + $id_router +"/"+ $page;
           window.location.href = URL;
        },
        directTo: function() {
            $fix = this.query.toLowerCase();
            console.log($fix)
            switch ($fix) {
                case _DATA_MENU_[0].toLowerCase():
                    this.goTo('dashboard');
                    break;
                case _DATA_MENU_[1].toLowerCase():
                    this.goTo('wireless-interface');
                    
                    break;
                case _DATA_MENU_[2].toLowerCase():
                    this.goTo('wireless-registration');
                    break;
                case _DATA_MENU_[3].toLowerCase():
                    this.goTo('interface');
                    break;
                case _DATA_MENU_[4].toLowerCase():
                    this.goTo('ppp-interface');
                    break;
                case _DATA_MENU_[5].toLowerCase():
                    this.goTo('ppp-servers');
                    break;
                case _DATA_MENU_[6].toLowerCase():
                    this.goTo('ppp-secrets');
                    break;
                case _DATA_MENU_[7].toLowerCase():
                    this.goTo('ppp-profiles');
                    break;
                case _DATA_MENU_[8].toLowerCase():
                    this.goTo('ipaddress');
                    break;
                case _DATA_MENU_[9].toLowerCase():
                    this.goTo('ipdns');
                    break;
                case _DATA_MENU_[10].toLowerCase():
                    this.goTo('iproute');
                    break;
                case _DATA_MENU_[11].toLowerCase():
                    this.goTo('ipfirewall');
                    break;
                case _DATA_MENU_[12].toLowerCase():
                    this.goTo('ippool');
                    break;
                case _DATA_MENU_[13].toLowerCase():
                    this.goTo('ipservice');
                    break;
                default:
                    break;
            }
        }
    }
})
</script>