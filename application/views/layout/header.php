<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">

        <?php 

        if (! isset($id_router)){
            $id_router = null;
        }
        if (($id_router)==null){
            echo '<li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown"
                        data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span
                            class="text">Welcome '.$username_.'</span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a style="cursor: pointer"  onclick="goToChangePassword();"><i class="icon icon-unlock"></i> Username & Password</a></li>
                        <li><a style="cursor: pointer" onclick="goToSetting();"><i class="icon icon-cogs"></i> Setting</a></li>
                        <li><a style="cursor: pointer" onclick="goToNewTab();"><i class="icon icon-external-link"></i> New Tab</a></li>
                        </ul>
                </li>';
        }

        ?>

        <li class=""><a style="cursor: pointer" onclick="logout();"><i class="icon-key"></i> <span class="text">Logout</span></a></li>
        <li class=""><a style="cursor: pointer" onclick="disconnectRouter();"><i class="icon-off"></i> <span class="text" style="color: red">Disconnect</span></a></li>
    </ul>
</div>


<script>
function goToChangePassword() {
    saveSidebarActive('sidebar_password_front')
    window.location.href = "<?= base_url('admin/username_password') ?>";
}
function goToSetting() {
    saveSidebarActive('sidebar_setting_front')
    window.location.href = "<?= base_url('admin/setting') ?>";
}

function goToNewTab(){
    window.open("<?= base_url() ?>");
}
</script>