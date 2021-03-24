function callServers() {

    $form_add_user_profiles.show_form = false;
    $form_generate_user.show_form = false;

    $loading.show = true;
    $$('txt_keterangan').innerHTML = 'Servers';
    $data_hotspot_server.show = true;
    $data_hotspot_profiles.show = false;
    $data_hotspot_users.show = false;
    $data_hotspot_users_profile.show = false;
    $data_hotspot_server.loadData();
    $data_hotspot_server.show = true;
    $$('btn_modal_add_server').setAttribute("style", "");
    $$('btn_modal_add_server_profiles').setAttribute("style", "display: none");
}



function callServerProfiles() {
    $form_add_user_profiles.show_form = false;
    $form_generate_user.show_form = false;

    $loading.show = true;
    $$('txt_keterangan').innerHTML = 'Server Profiles';
    $data_hotspot_profiles.show = true;
    $data_hotspot_server.show = false;
    $data_hotspot_users.show = false;
    $data_hotspot_users_profile.show = false;
    $data_hotspot_profiles.loadData();

    // $$('btn_modal_add_server').setAttribute("style", "display: none");
    $$('btn_modal_add_server_profiles').setAttribute("style", "");

}

function callUsers() {

    $form_generate_user.show_form = true;
    $form_add_user_profiles.show_form = false;

    $loading.show = true;

    $$('txt_keterangan').innerHTML = 'Users ';
    $data_hotspot_users.show = true;
    $data_hotspot_profiles.show = false;
    $data_hotspot_server.show = false;
    $data_hotspot_users_profile.show = false;
    $data_hotspot_users.loadData();

    // $$('btn_modal_add_server').setAttribute("style", "display: none");
    $$('btn_modal_add_server_profiles').setAttribute("style", "display: none");
}

function callUsersProfiles() {

    $form_add_user_profiles.show_form = true;
    $form_generate_user.show_form = false;

    $loading.show = true;

    $$('txt_keterangan').innerHTML = 'Users Profiles';
    $data_hotspot_users.show = false;
    $data_hotspot_profiles.show = false;
    $data_hotspot_server.show = false;
    $data_hotspot_users_profile.show = true;
    $data_hotspot_users_profile.loadData();

    //$$('btn_modal_add_server').setAttribute("style", "display: none");
    $$('btn_modal_add_server_profiles').setAttribute("style", "display: none");

}

window.onload = function() {
    $$('btn_generate_user').click();
}