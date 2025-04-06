<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit MCQ</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit MCQ </li>
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
      <?= form_open(base_url('/mcq/edit_mcq/' . $this->uri->segment(3)), [
        'name' => 'form_update_user',
        'id' => 'form_update_user',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-12">
        <div class="card-body">
          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Course</label>
            <div class="col-sm-5">
            <select name="course_id" class="form-control">
              <option>Select Course</option>
              <?php foreach (db_get_all_data('courses') as $row){?>
            <option <?php if($mcq_detail->course_id ==$row->id){echo 'selected';}?> value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php }?>
            </select>
            </div>
            <label for="inputName" class="col-sm-1 control-label">Chapter</label>
            <div class="col-sm-5">
            <select name="chapter_id" class="form-control">
              <option>Select Chapter</option>
              <?php foreach (db_get_all_data('chapters') as $row){?>
            <option <?php if($mcq_detail->chapter_id ==$row->id){echo 'selected';}?> value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php }?>
            </select>
            </div>
          </div>

          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Topic</label>
            <div class="col-sm-5">
            <select name="topic_id" class="form-control">
              <option>Select Topics</option>
              <?php foreach (db_get_all_data('topics') as $row){?>
            <option <?php if($mcq_detail->topic_id ==$row->id){echo 'selected';}?> value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php }?>
            </select>
            </div>
            <label for="inputProjectLeader" class="col-sm-1 control-label">No of Options</label>
            <div class="col-sm-5">
              <input type="number" id="inputProjectLeader" name="no_of_options" class="form-control" placeholder="No of Options"
                value="<?php echo $mcq_detail->no_of_options ?>">
            </div>
          </div>

   

          <!-- /.col -->
        </div>
      </div>
      <?= form_close(); ?>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <input  value="edit" class="btn btn-success update_user">
          <a href="#" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  $(document).ready(function () {
    $('.update_user').click(function () {

      var form_update_user = $('#form_update_user');
      var data_post = form_update_user.serializeArray();
      $.ajax({
        url: form_update_user.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {
            showStatusMessage('success', 'Success', res.message);
            setTimeout(() => {
              window.location.href = res.redirect;
            },5000);

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