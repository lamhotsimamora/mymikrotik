<div id="sidebar">
    <ul>
        <li id="sidebar_dashboard" class=""><a onclick="saveSidebarActive('sidebar_dashboard');"
                href="<?= base_url('admin/router/') . $data_router->{'id_router'} ?>"><i class="icon icon-home"></i>
                <span>Dashboard</span></a> </li>

        <li id="sidebar_wireless" class="submenu"> <a onclick="saveSidebarActive('sidebar_wireless');" href="#"><i
                    class="icon icon-bar-chart"></i> <span>Wireless</span> <span
                    class="label label-important"></span></a>
            <ul>
                <li id="sidebar_wireless_interface"><a onclick="saveSidebarActive('sidebar_wireless_interface');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/wireless-interface" ?>">Wireless
                        Interface</a>
                </li>
                <li id="sidebar_wireless_registration"><a onclick="saveSidebarActive('sidebar_wireless_registration');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/wireless-registration" ?>">Registration</a>
                </li>

            </ul></li>

        <li id="sidebar_interface" class=""><a onclick="saveSidebarActive('sidebar_interface');"
                href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/interface" ?>"><i
                    class="icon icon-inbox"></i> <span>Interface</span></a></li>
        <li id="sidebar_ppp" class="submenu"> <a onclick="saveSidebarActive('sidebar_ppp');" href="#"><i
                    class="icon icon-th-list"></i> <span>PPP</span> <span class="label label-important"></span></a>
            <ul>
                <li id="sidebar_ppp_interface"><a onclick="saveSidebarActive('sidebar_ppp_interface');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ppp-interface" ?>">Interface</a>
                </li>
                <li id="sidebar_ppp_servers"><a onclick="saveSidebarActive('sidebar_ppp_servers');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ppp-servers" ?>">Servers</a>
                </li>
                <li id="sidebar_ppp_secrets"><a onclick="saveSidebarActive('sidebar_ppp_secrets');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ppp-secrets" ?>">Secrets</a>
                </li>
                <li id="sidebar_ppp_profiles"><a onclick="saveSidebarActive('sidebar_ppp_profiles');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ppp-profiles" ?>">Profiles</a>
                </li>

            </ul>
        </li>
        <li id="sidebar_ip" class="submenu"> <a onclick="saveSidebarActive('sidebar_ip');" href="#"><i
                    class="icon icon-th-list"></i> <span>IP</span> <span class="label label-important"></span></a>
            <ul>
                <li id="sidebar_ipaddress"><a onclick="saveSidebarActive('sidebar_ipaddress');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ipaddress" ?>"> IP
                        Address</a></li>
                <li id="sidebar_ipdns"><a onclick="saveSidebarActive('sidebar_ipdns');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ipdns" ?>">IP DNS</a></li>
                <li id="sidebar_iproute"><a onclick="saveSidebarActive('sidebar_iproute');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/iproute" ?>">IP Route</a>
                </li>
                <li id="sidebar_ipfirewall"><a onclick="saveSidebarActive('sidebar_ipfirewall');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ipfirewall" ?>">IP
                        Firewall NAT</a></li>

                <li id="sidebar_ippool"><a onclick="saveSidebarActive('sidebar_ippool');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ippool" ?>">IP Pool</a>
                </li>
                <li id="sidebar_ipservice"><a onclick="saveSidebarActive('sidebar_ipservice');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/ipservice" ?>">IP
                        Service</a>
                </li>

            </ul>
        </li>
        <li id="sidebar_system" class="submenu"> <a onclick="saveSidebarActive('sidebar_system');" href="#"><i
                    class="icon  icon-cogs"></i> <span>System</span> <span class="label label-important"></span></a>
            <ul>
                <li id="sidebar_beep"><a onclick="testBeeP()" href="#beep">
                        Beep</a></li>
                <li id="sidebar_package">
                    <a onclick="saveSidebarActive('sidebar_package');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/package" ?>">Package
                    </a>
                </li>
                <li id="sidebar_log"><a onclick="saveSidebarActive('sidebar_log')"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/log" ?>">Log</a></li>
                <li id="sidebar_files"><a onclick="saveSidebarActive('sidebar_files')"
                href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/files" ?>">Files</a></li>
                <li id="sidebar_backup"><a onclick="backupRouter();" href="#">Auto Backup</a></li>

                <li id="sidebar_reboot"><a onclick="rebootRouter();" href="#">Reboot</a></li>

            </ul>
        </li>
        <li id="sidebar_hotspot" class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Hotspot</span>
                <span class="label label-important"></span></a>
            <ul>
                <li id="sidebar_hotspot_server"><a onclick="saveSidebarActive('sidebar_hotspot_server');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-server" ?>">Server</a>
                </li>
                <li id="sidebar_hotspot_server_profiles"><a
                        onclick="saveSidebarActive('sidebar_hotspot_server_profiles');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-profile-server" ?>">Server
                        Profiles</a></li>
                <li id="sidebar_hotspot_user"><a onclick="saveSidebarActive('sidebar_hotspot_user');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-user-profile" ?>">User
                        Profiles</a></li>
                <li id="sidebar_hotspot_user_single"><a onclick="saveSidebarActive('sidebar_hotspot_user_single');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-user-single" ?>">
                        <i clas="icon icon-user"></i> New User</a></li>
                <li id="sidebar_hotspot_user_multiple"><a onclick="saveSidebarActive('sidebar_hotspot_user_multiple');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/hotspot-user-multiple" ?>">
                        <i clas="icon icon-user"></i> Multiple User</a></li>
                <li id="sidebar_useractive"><a onclick="saveSidebarActive('sidebar_useractive');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/useractive" ?>">Active</a>
                </li>


            </ul>
        </li>
        <li id="sidebar_queues"><a onclick="saveSidebarActive('sidebar_queues');"
                href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/queues" ?>"><i
                    class="icon icon-tint"></i> <span>Queues</span></a></li>

        <li id="sidebar_tool" class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Tool</span>
                <span class="label label-important"></span></a>
            <ul>
                <li id="sidebar_tool_netwatch"><a onclick="saveSidebarActive('sidebar_tool_netwatch');"
                        href="<?= base_url('admin/router/') . $data_router->{'id_router'} . "/netwatch" ?>">Netwatch</a>
                </li>
            </ul>
        </li>



        <div id="resource_monitor" v-cloak>
            <li class="content"> <span>CPU {{cpu_freq}} MHz</span>
                <div class="progress progress-mini progress-danger active progress-striped">
                    <div :style="template_cpu_load" class="bar"></div>
                </div>
                <span class="percent">{{cpu_load}}</span>
                <div class="stat"></div>
            </li>

            <li class="content"> <span>Free HDD : {{ hdd }} MB</span>
                <div class="progress progress-mini active progress-striped">
                    <div :style="template_hdd_persen" class="bar"></div>
                </div>
                <span class="percent">{{ hdd_persen }}%</span>
            </li>

            <li class="content"> <span> Free Memory : {{ memory }} MB</span>
                <div class="progress progress-mini progress-success active progress-striped">
                    <div :style="template_memory_persen" class="bar"></div>
                </div>
                <span class="percent">{{memory_persen}}%</span>
            </li>


            <li class="content"> <span>Version - RouterBoard</span>
                <div class="stat" style="color:#f9ca24 ">{{ version }} - {{ routerboard }} ( {{ architecture }} )</div>
            </li>
            <li class="content"> <span>Health ( Voltage / Temperature )</span>
                <div class="stat" style="color:#f0b570">{{ voltage }} V / {{ temperature }} C</div>
            </li>
        </div>

        <li><a href="#" class="" onclick="disconnectRouter();"><i class="icon icon-off"></i> <span
                    style="color: red">Disconnect</span></a></li>
    </ul>
</div>

<script>
function testBeeP() {
    jnet({
        url: URL_API_BEEP_ROUTER,
        method: 'post',
        data: {
            _token: _TOKEN_,
            _id_router: $id_router,
            _id_admin: Cookies.get('id_admin'),
            _ip_address: $ip_address,
            _username: $username,
            _password: $password,
            _ip_address: $ip_address,
            _port: $port
        }
    }).request();
}

let $dashboard_active = localStorage.getItem("sidebar_active") ? localStorage.getItem('sidebar_active') :
    'sidebar_dashboard';


setActiveSidebar($dashboard_active);


function saveSidebarActive($id) {
    localStorage.setItem("sidebar_active", $id);
}

function backupRouter(){
    let r = confirm("Pilih yes jika anda ingin membackup konfigurasi Router ini...!");

    if (r == true) {
        jnet({
            url: URL_API_BACKUP_ROUTER,
            method: 'post',
            data: {
                _token: _TOKEN_,
                _ip_address: $ip_address,
                _username: $username,
                _password: $password,
                _ip_address: $ip_address,
                _port: $port
            }
        }).request($response => {
            if ($response==='T') {
                alert("Backup berhasil dilakukan!");
            }
        });
    }
}

function rebootRouter() {

    let r = confirm("Yakin ingin reboot router ? ");

    if (r == true) {
        jnet({
            url: URL_API_REBOOT_ROUTER,
            method: 'post',
            data: {
                _token: _TOKEN_,
                _id_router: $id_router,
                _id_admin: Cookies.get('id_admin'),
                _ip_address: $ip_address,
                _username: $username,
                _password: $password,
                _ip_address: $ip_address,
                _port: $port
            }
        }).request($response => {
            if ($response) {
                if ($response === 'T') {
                    window.location.href = URL_DASHBOARD;
                    return;
                }
                window.location.href = URL_DASHBOARD;
            }
        });
    }
}

new Vue({
    el: '#resource_monitor',
    data: {
        memory: null,
        hdd: null,
        router: null,
        version: null,
        template_cpu_load: null,
        cpu_load: null,
        hdd_persen: null,
        template_hdd_persen: null,
        memory_persen: null,
        template_memory_persen: null,
        routerboard: null,
        cpu_freq: null,
        architecture: null,
        uptime: null,
        voltage: null,
        temperature: null
    },
    methods: {
        loadHealth: function() {
            jnet({
                url: URL_API_GET_HEALTH_SYSTEM,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _ip_address: $ip_address,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    const obj = JSON.parse($response);

                    if (obj) {
                        const result = obj[0];

                        if (result) {

                            const voltage = result.voltage;
                            const temperature = result.temperature;

                            this.voltage = voltage;
                            this.temperature = temperature;
                        }else{
                            this.voltage = '0';
                            this.temperature = '0';
                        }

                    }
                }
            });
        },
        loadResource: function() {
            jnet({
                url: URL_API_LOAD_RESOURCE,
                method: 'post',
                data: {
                    _token: _TOKEN_,
                    _ip_address: $ip_address,
                    _username: $username,
                    _password: $password,
                    _ip_address: $ip_address,
                    _port: $port
                }
            }).request($response => {
                if ($response) {
                    if ($response === 'INPUT IS EMPTY') {
                        console.log("Upzzz Something Is Wrong, Input Is Empty")
                        return;
                    }
                    let $object = JSON.parse($response);

                    if ($object) {

                              $obj = $object[0];
                              $cpu = $obj['cpu-load'];
                              $router = $obj['board-name'];
                              $free_hdd = $obj['free-hdd-space'];
                              $total_hdd = $obj['total-hdd-space'];
                              $memory = $obj['free-memory'];
                              $total_memory = $obj['total-memory'];
                              $version = $obj['version'];
                              $uptime = $obj['uptime'];
                              this.architecture = $obj['architecture-name'];

                              this.routerboard = $obj['board-name'];
                              this.cpu_freq = $obj['cpu-frequency'];

                              this.memory = Math.ceil($memory * 0.000001);
                              this.hdd = Math.ceil($free_hdd * 0.000001);
                              this.router = $router;
                              this.version = $version;

                              this.template_cpu_load = `width: ${$cpu}%;`
                              this.cpu_load = `${$cpu}%`;

                              this.hdd_persen = Math.ceil((($total_hdd - $free_hdd) / $total_hdd) * 100);
                              this.memory_persen = Math.ceil((($total_memory - $memory) / $total_memory) *
                                  100);

                              this.template_hdd_persen = `width: ${this.hdd_persen}%;`;

                              this.template_memory_persen = `width: ${this.memory_persen}%;`;

                              if (typeof $count_data != "undefined") {

                                  $uptime = $uptime._replace('m', ' m, ');
                                  $uptime = $uptime._replace('h', ' h, ');
                                  $uptime = $uptime._replace('d', ' d, ');
                                  $uptime = $uptime._replace('s', ' s');
                                  $count_data.uptime = $uptime
                              }

                    }
                }
            });
        }
    },
    mounted() {
        setInterval(this.loadResource(), 2000);
        this.loadHealth();
    },
})
</script>