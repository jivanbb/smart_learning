<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Course List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Course List </li>
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
      <?= form_open(base_url('/course/save_course/'), [
        'name' => 'form_create_course',
        'id' => 'form_create_course',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-8">
        <div class="card-body">
          <div class="form-group">
            <label for="inputName">Board/University</label>
            <select class="form-control select2" name="board_id"  style="width: 100%;">
              <option>Select Board/University</option>
              <?php foreach($board_list as $board){?>
              <option value="<?php echo $board->id;?>"><?php echo $board->name;?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputName">Course Name <i class="required">*</i></label>
            <input type="text" id="inputName" name="course_name" class="form-control">
          </div>

         
          <div class="form-group">
            <label for="inputClientCompany">Amount <i class="required">*</i></label>
            <input type="text" id="inputClientCompany" name="amount" class="form-control">
          </div>

          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
        <input type="submit" value="save" class="btn btn-success create_course">
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
    $('.create_course').click(function () {
      var form_create_course = $('#form_create_course');
      var data_post = form_create_course.serializeArray();
      $.ajax({
        url: form_create_course.attr('action'),
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