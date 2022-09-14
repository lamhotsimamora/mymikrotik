<div id="search">
    <input ref="query" v-model="query" type="text" @keypress="enterSearch($event)" placeholder="Search" />
    <button @click="search" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>

<script>
new Vue({
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
                    this.goTo();
                    break;
                case _DATA_MENU_[1].toLowerCase():
                    this.goTo('interface');
                    break;
                default:
                    break;
            }
        }
    }
})
</script>