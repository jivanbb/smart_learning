  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Permission List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permission List </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <!-- <button type="button" class="btn btn-flat btn-success btn_add_new float-right" data-toggle="modal" data-target="#new_role"><i class="fa fa-plus"></i> Create</button> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SN.</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $sn =0;
                    foreach($permission_list as $permission){
                      $sn++;?>
                  <tr>
                    <td><?php echo $sn;?></td>
                    <td></td>
                    <td>
                       <!-- <a href="<?= base_url('/role/edit/'.$role->id); ?>"  class="label-default btn-act-edit"><i class="fa fa-edit "></i> </a> -->
                      </td>
                  </tr>
                <?php }?>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div id="new_role" class="modal fade new-july-design" role="dialog">

<div class="modal-dialog modal-md">
   <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Create Role</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body new-july-design">
         <?= form_open(base_url('role/save_role'), [
            'name' => 'form_role_add',
            'class' => 'form-horizontal',
            'id' => 'form_role_add',
            'enctype' => 'multipart/form-data',
            'method' => 'POST'
         ]); ?>
         <div class="form-group group-name ">
            <label for="name" class="col-sm-4 control-label"> Name<i class="required">*</i>
            </label>
            <div class="col-sm-8">
               <input type="text" class="form-control" name="name" id="name" placeholder=" Name" value="<?= set_value('name'); ?>">
               <small class="info help-block">
               </small>
            </div>
         </div>
      </div>
      <div class="modal-footer pr-5p">
         <button class="btn  btn-primary btn_save  btn_action " id="btn_save" data-stype='stay'> Save
            <button type="button" class="btn   btn-close" data-dismiss="modal">Close</button>
      </div>
      <?= form_close(); ?>

   </div>
</div>

</div>
<script>
  $(document).ready(function () {
    $('.btn_save').click(function () {
      var form_role_add = $('#form_role_add');
      var data_post = form_role_add.serializeArray();
      $.ajax({
        url: form_role_add.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {
            showStatusMessage('success', 'Success', res.message);
            setTimeout(() => {
              window.location.reload(true);
            });

          } else {
            showValidationMessage(`${res.message}`);
          }

        })
        .fail(function () {
          showStatusMessage('error', 'Error', 'Error save data');
        })
        .always(function () {
          $('.loading').hide();
          $('html, body').animate({
            scrollTop: $(document).height()
          }, 2000);
        });

      return false;
    }); /*end btn save*/
  });
</script>
  
