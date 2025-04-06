<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create MCQ</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create MCQ </li>
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
      <?= form_open(base_url('/mcq/save_mcq/'), [
        'name' => 'form_create_user',
        'id' => 'form_create_user',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-12">
        <div class="card-body">

          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Course</label>
            <div class="col-md-5">
            <select name="course_id" class="form-control">
              <option>Select Course</option>
              <?php foreach (db_get_all_data('courses') as $row){?>
            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php }?>
            </select>
            </div>
            <label for="inputName" class="col-sm-1 control-label">Chapter</label>
            <div class="col-md-5">
            <select name="chapter_id" class="form-control">
              <option>Select Chapter</option>
              <?php foreach (db_get_all_data('chapters') as $row){?>
            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php }?>
            </select>
            </div>
          </div>

          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Topic</label>
            <div class="col-md-5">
            <select name="topic_id" class="form-control">
              <option>Select Topic</option>
              <?php foreach (db_get_all_data('topics') as $row){?>
            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php }?>
            </select>
            </div>
            <label for="inputProjectLeader" class="col-sm-1 control-label">No of Options</label>
            <div class="col-md-5">
              <input type="number" id="inputProjectLeader" name="no_of_options" class="form-control" placeholder="No of Options">
            </div>

          </div>

          <!-- /.col -->
        </div>

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <input value="save" class="btn btn-success create_user">
          <a href="#" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
      <?= form_close(); ?>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  $(document).ready(function () {
    $('.create_user').click(function () {

      var form_create_user = $('#form_create_user');
      var data_post = form_create_user.serializeArray();
      $.ajax({
        url: form_create_user.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {
            showStatusMessage('success', 'Success', res.message);
            setTimeout(() => {
              window.location.href = res.redirect;
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