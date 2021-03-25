<div id="sidebar">
  <!-- <a href="#" class="visible-phone"><i class="icon icon-home"></i> Homes</a> -->
    <ul>
        <li id="sidebar_home_front" class="active"><a onclick="saveSidebarActive('sidebar_home_front')" href="<?= base_url('admin') ?>"><i class="icon icon-home"></i> <span>Home</span></a> </li>
        <li id="sidebar_password_front" class=""><a onclick="saveSidebarActive('sidebar_password_front')" href="<?= base_url('admin/username_password') ?>"><i class="icon icon-unlock"></i> <span>Username & Password</span></a> </li>
       
        <li id="sidebar_setting_front" class=""><a onclick="saveSidebarActive('sidebar_setting_front')" href="<?= base_url('admin/setting') ?>"><i class="icon icon-cogs"></i> <span>Setting</span></a> </li>
        <li id="sidebar_about_front" class=""><a onclick="saveSidebarActive('sidebar_about_front')" href="<?= base_url('admin/about') ?>"><i class="icon icon-exclamation-sign"></i> <span>About</span></a> </li>
        
      </ul>
</div>

<script>
 let $dashboard_active = localStorage.getItem("sidebar_active_front") 
 ? 
 localStorage.getItem('sidebar_active_front') :
 'sidebar_home_front';

  function setActive(el){
    $$(el).setAttribute('class','active');
  
    if ($dashboard_active==='sidebar_home_front'){
        $$('sidebar_password_front').setAttribute('class','');
        $$('sidebar_setting_front').setAttribute('class','');
        $$('sidebar_about_front').setAttribute('class','');
       
    }

    if ($dashboard_active==='sidebar_password_front'){
        $$('sidebar_home_front').setAttribute('class','');
        $$('sidebar_setting_front').setAttribute('class','');
        $$('sidebar_about_front').setAttribute('class','');
    }

    if ($dashboard_active==='sidebar_setting_front'){
        $$('sidebar_password_front').setAttribute('class','');
        $$('sidebar_home_front').setAttribute('class','');
        $$('sidebar_about_front').setAttribute('class','');
    }

    if ($dashboard_active==='sidebar_about_front'){
        $$('sidebar_password_front').setAttribute('class','');
        $$('sidebar_home_front').setAttribute('class','');
        $$('sidebar_setting_front').setAttribute('class','');
    }

  }
 


  function saveSidebarActive($id) {
    localStorage.setItem("sidebar_active_front", $id);
}

setActive($dashboard_active);
</script>