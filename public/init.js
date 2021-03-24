let URL_SERVER = '';
if (localStorage.getItem('_URL_SERVER_')) {
    URL_SERVER = localStorage.getItem('_URL_SERVER_');
} else {
    localStorage.setItem('_URL_SERVER_', __URL_SERVER_FROM_CI__);
    window.location.reload();
}


const URL_API_LOGIN = `${URL_SERVER}admin/proccessLogin`;
const URL_API_CHECK_LOGIN = `${URL_SERVER}admin/checkLogin`;


const URL_API_CHANGE_PASSWORD = `${URL_SERVER}admin/changePassword`;


const URL_API_SAVE_ROUTER = `${URL_SERVER}admin/saveRouter`;
const URL_API_LOAD_DATA_ROUTER = `${URL_SERVER}admin/loadDataRouter`;
const URL_API_LOAD_DATA_ROUTER_NEW = `${URL_SERVER}admin/loadDataRouterNew`;
const URL_API_DELETE_ROUTER = `${URL_SERVER}admin/deleteRouter`;
const URL_API_UPDATE_ROUTER = `${URL_SERVER}admin/updateRouter`;


const URL_API_PING_ROUTER = `${URL_SERVER}api/pingRouter`;
const URL_API_BACKUP_ROUTER = `${URL_SERVER}api/backupRouter`;
const URL_API_LOGIN_ROUTER = `${URL_SERVER}api/loginRouter`;
const URL_API_LOAD_RESOURCE = `${URL_SERVER}api/getResource`;
const URL_API_GET_HEALTH_SYSTEM = `${URL_SERVER}api/getHealthSystem`;

const URL_API_ROUTER_INTERFACE = `${URL_SERVER}api/getInterface`;
const URL_API_ROUTER_IPADDRESS = `${URL_SERVER}api/getIpAddress`;
const URL_API_ROUTER_IPDNS = `${URL_SERVER}api/getIpDNS`;
const URL_API_ROUTER_IPROUTE = `${URL_SERVER}api/getIpRoute`;
const URL_API_ROUTER_IPFIREWALL = `${URL_SERVER}api/getIpFirewall`;

const URL_API_GET_ROUTER_IDENTITY = `${URL_SERVER}api/getRouterIdentity`;

const URL_API_ROUTER_SERVER_HOTSPOT = `${URL_SERVER}api/getServerHotspot`;
const URL_API_ROUTER_SERVER_PROFILES = `${URL_SERVER}api/getServerProfile`;
const URL_API_HOTSPOT_SERVER_PROFILE_DELETE = `${URL_SERVER}api/deleteHotspotServerProfile`;
const URL_API_ROUTER_SERVER_USERS = `${URL_SERVER}api/getUsersVoucher`;
const URL_API_ROUTER_USER_ACTIVE_HOTSPOT = `${URL_SERVER}api/getUsersHotspotActive`;

const URL_API_ROUTER_USER_QUEUE_HOTSPOT = `${URL_SERVER}api/getQueue`;
const URL_API_REBOOT_ROUTER = `${URL_SERVER}api/rebootRouter`;

const URL_API_ROUTER_SERVER_USERS_PROFILE_GET = `${URL_SERVER}api/getServerUserProfiles`;
const URL_API_ROUTER_SERVER_USERS_PROFILE_DELETE = `${URL_SERVER}api/deleteServerUserProfiles`;

const URL_API_ROUTER_ADD_USERS_PROFILE = `${URL_SERVER}api/addUserProfileHotspot`;
const URL_API_ROUTER_GENERATE_USER_VOUCHER = `${URL_SERVER}api/generateUserVoucher`;
const URL_API_ROUTER_NEW_USER_VOUCHER = `${URL_SERVER}api/addUserVoucher`;

const URL_API_IP_POOL_ADD = `${URL_SERVER}api/addIpPool`;
const URL_API_ROUTER_IPPOOL_GET = `${URL_SERVER}api/getIpPool`;
const URL_API_ROUTER_IPPOOL_DELETE = `${URL_SERVER}api/deleteIpPool`;

const URL_API_PPP_GET_INTERFACE = `${URL_SERVER}api/getPPPInterface`;
const URL_API_PPP_GET_SERVERS = `${URL_SERVER}api/getPPPoEServers`;
const URL_API_PPP_GET_SECRETS = `${URL_SERVER}api/getPPPoESecrets`;
const URL_API_PPP_GET_PROFILES = `${URL_SERVER}api/getPPPoEProfiles`;

const URL_API_IP_ADDRESS_ADD = `${URL_SERVER}api/addIpAddress`;
const URL_API_IP_ADDRESS_DELETE = `${URL_SERVER}api/deleteIpAddress`;
const URL_API_DELETE_USER_VOUCHER = `${URL_SERVER}api/deleteUserVoucher`;

const URL_ADMIN_SEARCH_ROUTER = `${URL_SERVER}admin/searchRouter`;

const URL_API_LOG = `${URL_SERVER}api/getLog`;
const URL_API_FILES = `${URL_SERVER}api/getFiles`;
const URL_API_NETWATCH = `${URL_SERVER}api/getNetwatch`;
const URL_API_PACKAGE = `${URL_SERVER}api/getPackage`;
const URL_API_GET_IPSERVICE = `${URL_SERVER}api/getIpService`;
const URL_API_DELETE_IP_FIREWALL = `${URL_SERVER}api/deleteIpFirewall`;

const URL_API_DISABLE_IP_FIREWALL = `${URL_SERVER}api/disableIpFirewall`;
const URL_API_ENABLE_IP_FIREWALL = `${URL_SERVER}api/enableIpFirewall`;

const URL_API_DISABLE_INTERFACE = `${URL_SERVER}api/disableInterface`;
const URL_API_ENABLE_INTERFACE = `${URL_SERVER}api/enableInterface`;

const URL_DASHBOARD = `${URL_SERVER}admin/index`;
const URL_LOGIN = `${URL_SERVER}admin/login`;
const URL_ROUTER_CONNECT = `${URL_SERVER}admin/router/`;
const URL_API_BEEP_ROUTER = `${URL_SERVER}api/testBeep/`;

const URL_API_UPDATE_IPSERVICE = `${URL_SERVER}api/updateIpService`;
const URL_API_GET_WIRELESS_INTERFACE = `${URL_SERVER}api/getWirelessInterface`;
const URL_API_GET_Security_Profiles_Wireless = `${URL_SERVER}api/getSecurityProfilesWireless`;
const URL_API_GET_WIRELESS_REGISTRATION = `${URL_SERVER}api/getWirelessRegistration`;
const URL_API_RECONNECT_WIRELESS_REGISTRATION = `${URL_SERVER}api/reconnectWirelessRegistration`;

const URL_API_CLEAR_ROUTER_DATA_JSON = `${URL_SERVER}admin/clearDataRouterJson`;
const URL_API_SEARCH_CLIENT = `${URL_SERVER}client/searchData`;

const URL_API_IP_FIREWALL_NAT_ADD = `${URL_SERVER}api/addIpFirewallNat`;
const URL_API_QUEUES_ADD = `${URL_SERVER}api/addQueues`;
const URL_API_QUEUES_DELETE = `${URL_SERVER}api/deleteQueues`;
const URL_API_INTERFACE_NAME_CHANGE = `${URL_SERVER}api/interfaceChangeName`;

const URL_API_PPP_PROFILE_ADD = `${URL_SERVER}api/pppProfilesAdd`;
const URL_API_PPP_PROFILE_DELETE = `${URL_SERVER}api/pppProfilesDelete`;
const URL_API_PPP_SECRET_ADD = `${URL_SERVER}api/pppSecretAdd`;
const URL_API_PPP_SECRET_DELETE = `${URL_SERVER}api/pppSecretDelete`;
const URL_API_PPP_SERVER_ADD = `${URL_SERVER}api/pppServerAdd`;
const URL_API_PPP_SERVER_DELETE = `${URL_SERVER}api/pppServerDelete`;

// ==================================

const URL_API_LOAD_DATA_CLIENT = `${URL_SERVER}client/load`;
const URL_API_USER_DELETE = `${URL_SERVER}client/delete`;
const URL_API_LOAD_DATA_JENIS = `${URL_SERVER}jenis/load`;
const URL_API_CLIENT_ADD = `${URL_SERVER}client/add`;
const URL_API_PAYMENT_ADD = `${URL_SERVER}payment/add`;
const URL_API_BANDWITH_ADD = `${URL_SERVER}bandwith/add`;
const URL_API_JENIS_ADD = `${URL_SERVER}jenis/add`;
const URL_API_JENIS_DELETE = `${URL_SERVER}jenis/delete`;
const URL_API_BANDWITH_DELETE = `${URL_SERVER}bandwith/delete`;
const URL_API_LOAD_DATA_PAYMENT = `${URL_SERVER}payment/load`;
const URL_API_LOAD_DATA_BANDWITH = `${URL_SERVER}bandwith/load`;
const URL_API_PAYMENT_DELETE = `${URL_SERVER}payment/delete`;

const URL_API_HOTSPOT_SERVER_ADD = `${URL_SERVER}api/hotspotServerAdd`;
const URL_API_HOTSPOT_SERVER_DELETE = `${URL_SERVER}api/hotspotServerDelete`;
const URL_API_FILE_DIRECTORY_GET = `${URL_SERVER}api/htmlDirectoryGet`;

const URL_API_HOTSPOT_SERVER_PROFILE_ADD = `${URL_SERVER}api/hotspotServerProfileAdd`;

// ==================================


function logout() {
    var r = confirm("Yakin mau logout dari aplikasi ?");
    if (r == true) {
        Cookies.remove('id_admin')
        location.reload();
    }

}

function disconnectRouter() {
    var r = confirm("Yakin mau logout dari router ?");
    if (r == true) {
        window.location.href = URL_DASHBOARD;
    }
}


function $$(el) {
    return document.getElementById(el);
}


function setActiveSidebar($el = null, $ell = null) {
    if ($el == null) {
        return;
    }
    if ($el) {
        $$($el).setAttribute("class", "active");

        if ($el === 'ipaddress' || $el === 'ipdns' || $el === 'iproute' || $el === 'ipfirewall') {
            $$('sidebar_ip').setAttribute("class", "submenu active");
        }

        if ($ell != null) {
            setActiveSidebar($ell);
        }
    }
}


const _DATA_MENU_ = [
    'Dashboard',
    'Wireless Interface',
    'Wireless Registration',
    'Interface',
    'PPP Interface',
    'PPP Servers',
    'PPP Secrets',
    'PPP Profiles',
    'IP Address',
    'IP DNS',
    'IP Route',
    'IP Firewall',
    'IP Pool',
    'System Beep',
    'System Package',
    'System Files',
    'System Log',
    'System Reboot',
    'Queues',
    'Hotspot Server',
    'Hotspot Server Profiles',
    'Hotspot User Profiles',
    'Hotspot New User',
    'Hotspot Multiple User',
    'Hotspot Active',
    'Disconnect',
    'Netwatch',
    'Logout',

]


const _URL_PAGE_ = URL_SERVER + 'admin/router/';


String.prototype._replace = function(s, r) {
    return this.split(s).join(r)
};

function convertByte(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    if (i == 0) return bytes + ' ' + sizes[i];
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
}