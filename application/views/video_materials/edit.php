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
      <div class="col-md-8">
        <div class="card-body">
          <?php $id =$this->uri->segment(3);?>
          <?= form_open(base_url('/course/edit_course/'.$id), [
            'name' => 'form_create_course',
            'id' => 'form_update_course',
            'method' => 'POST'
          ]); ?>
          <div class="form-group">
            <label for="inputName">Board/University</label>
            <select class="form-control select2"  name="board_id" style="width: 100%;">
              <?php foreach ($board_list as $board) { ?>
                <option <?php if ($board->id == $course_detail->board_id) {
                  echo 'selected';
                } ?>
                  value="<?php echo $board->id ?>"><?php echo $board->name; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputName">Course Name</label>
            <input type="text" id="inputName" name="name" class="form-control"
              value="<?php echo $course_detail->name; ?>">
          </div>


          <div class="form-group">
            <label for="inputClientCompany">Amount</label>
            <input type="text" id="inputClientCompany" name="amount" class="form-control"
              value="<?php echo $course_detail->amount; ?>">
          </div>

          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <input  value="edit" class="btn btn-success update_course">
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
    $('.update_course').click(function () {

      var form_update_course = $('#form_update_course');
      var data_post = form_update_course.serializeArray();
      $.ajax({
        url: form_update_course.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {
            showStatusMessage('success', 'Success', res.message);
            setTimeout(() => {
              window.location.href = res.redirect;
            },2000);

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