<!DOCTYPE html>
<html lang="en">

<head>
  <title>My Mikrotik</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url('public/'); ?>css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="<?= base_url('public/'); ?>css/uniform.css" />
  <link rel="stylesheet" href="<?= base_url('public/'); ?>css/select2.css" />
  <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-style.css" />
  <link rel="stylesheet" href="<?= base_url('public/'); ?>css/matrix-media.css" />
  <link href="<?= base_url('public/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="<?= base_url('public/css/'); ?>font-google.css" rel="stylesheet" />
  <link rel="icon" href="<?= base_url('public/') ?>img/router.png" type="image/gif" sizes="16x16">  
  <script src="<?= base_url('public/'); ?>js/vue.js"></script>
  <script src="<?= base_url('public/'); ?>js/js.cookie.min.js"></script>
  <script src="<?= base_url('public/'); ?>js/jnet.js"></script>
  <style>
    [v-cloak] {
      display: none;
    }
  </style>
</head>

<body>

   <script src="<?= base_url('public/'); ?>init.js"></script>
  <script>
    // check id admin in storage
    const _TOKEN_ = "<?= _TOKEN_APP_ ?>";
  </script>
  <script>
    const $id_router  = "<?= $data_router->{'id_router'} ?>";
    const $username   = "<?= $data_router->{'username_'} ?>";
    const $password   = "<?= $data_router->{'password_'} ?>";
    const $ip_address = "<?= $data_router->{'ip_address'} ?>";
    const $port        = "<?= $data_router->{'port_api'} ?>";
  </script>

  <!--Header-part-->
  <div id="header">
    <h1><a href="#">Queues</a></h1>
  </div>
  <!--close-Header-part-->

  <!--top-Header-menu-->
  <?php include 'layout/header.php'; ?>

  <!--start-top-serch-->
  <?php include('layout/search.php'); ?>
  <!--close-top-serch-->

  <!--sidebar-menu-->
  <?php include 'layout/sidebar.php'; ?>

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> 
      <?php include 'layout/small-header.php'; ?>
      <a onclick="saveSidebarActive('sidebar_queues');" href="<?= base_url('admin/router/') . $data_router->{'id_router'}."/queues" ?>" class="current">Queues</a> 
 
      </div>
      <h1>Queues </h1>
    </div>
    <div class="container-fluid">
      <hr>
      <div class="row-fluid">
        <div class="span12">

          <div class="widget-box">
            <div class="widget-title">
            <center>
                <button href="#modal_add" data-toggle="modal" class="btn btn-primary btn-mini">+</button>
              </center>
            </div>
            <div class="widget-content nopadding" id="queues" v-cloak>


              <table class="table table-bordered">
                <thead>
                  <tr>
                  
                    <th>Name</th>
                    <th>Target</th>
                    <th>Upload / Download Max Limit</th>
                    <th>Priority</th>
                    <th>Bytes</th>
                    <th>Dynamic</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(data,i) in data_queues">
                   
                    <td><strong>{{data.name}}</strong></td>
                    <td>{{data.target}}</td>
                    <td v-html="resultByte(data['max-limit'])"></td>
                    <td>{{data.priority}}</td>
                    <td v-html="resultByte(data.bytes)"></td>
                    <td>{{data.dynamic}}</td>
                    <td>
                      <button @click="deleteData(data['.id'])" class="btn btn-danger btn-mini">x</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
  <!--Footer-part-->

  <div id="modal_add" class="modal hide">
    <div class="modal-header">
      <button id="btn_close_modal" data-dismiss="modal" class="close" type="button">x</button>
      <h3></h3>
    </div>
    <div class="modal-body">
      <div class="control-group">
        <label class="control-label">Name</label>
        <div class="controls">
          <input type="text" class="span4" ref="name" v-model="name" placeholder="Name" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Target</label>
        <div class="controls">
          <input type="text" class="span4" ref="target" v-model="target" placeholder="20.20.15.10" />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Target Upload</label>
        <div class="controls">
          <select v-model="upload">
            <option v-for="upload in data_upload" :value="upload.speed">{{upload.speed}}</option>
          </select>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Target Download</label>
        <div class="controls">
          <select v-model="download">
            <option v-for="download in data_download" :value="download.speed">{{download.speed}}</option>
          </select>
        </div>
      </div>


      <button class="btn btn-primary btn-md" @click="save">Save</button>

    </div>
  </div>
  <?php include 'layout/footer.php'; ?>

  <!--end-Footer-part-->
  <script src="<?= base_url('public/'); ?>js/jquery.min.js"></script>
  <script src="<?= base_url('public/'); ?>js/jquery.ui.custom.js"></script>
  <script src="<?= base_url('public/'); ?>js/bootstrap.min.js"></script>
  <script src="<?= base_url('public/'); ?>js/jquery.uniform.js"></script>
 
  <script src="<?= base_url('public/'); ?>js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('public/'); ?>js/matrix.js"></script>
 

  <script src="<?= base_url('public/') ?>queues.js"></script>
  <script src="<?= base_url('public/') ?>auth-login.js"></script>
  <script src="<?= base_url('public/') ?>identity.js"></script>
</body>

</html>