<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">MCQ Setup List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">MCQ Setup List </li>
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
      <?= form_open(base_url('/mcq_setup/save_mcq/'), [
        'name' => 'form_create_mcq',
        'id' => 'form_create_mcq',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-12">
        <div class="card-body">
          <div class="row form-group">
            <label for="inputName" class="col-sm-2 control-label">Course</label>
            <div class="col-md-4">
              <select class="form-control select2" name="course_id" style="width: 100%;" id="course_id">
                <option>Select Course</option>
                <?php foreach (db_get_all_data('courses') as $row) { ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                <?php } ?>
              </select>
            </div>
            <label for="inputName" class="col-sm-2 control-label">Time(In Min) <i class="required">*</i></label>
            <div class="col-md-4">
              <input type="number" id="inputName" name="time" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-2 control-label">Full Marks <i class="required">*</i></label>
            <div class="col-md-4">
            <input type="text" id="inputClientCompany" name="full_marks" class="form-control">
            </div>
            <label for="inputClientCompany" class="col-sm-2 control-label">Pass Marks <i class="required">*</i></label>
            <div class="col-md-4">
            <input type="text" id="inputClientCompany" name="pass_marks" class="form-control">
            </div>
          </div>
  
          <div id="exam_table">

          </div>

          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <input type="submit" value="save" class="btn btn-success create_mcq">
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
    $('.create_mcq').click(function () {
      var form_create_mcq = $('#form_create_mcq');
      var data_post = form_create_mcq.serializeArray();
      $.ajax({
        url: form_create_mcq.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {
            showStatusMessage('success', 'Success', res.message);
            setTimeout(() => {
              window.location.href = res.redirect;
            }, 5000);

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


    $('#course_id').change(function () {
      var course_id = $(this).val();
      if (course_id !== '') {
        $.ajax({
          type: 'GET',
          data: course_id,
          dataType: 'html',
          url: BASE_URL + 'mcq_setup/getChapter/' + course_id,
          success: function (html) {
            $('#exam_table').html(html);
          }
        });
      }
    });
  });
</script>