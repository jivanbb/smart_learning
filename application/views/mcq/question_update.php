<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Update Question</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Update Question </li>
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
      <?= form_open(base_url('/mcq/update_question/' . $this->uri->segment(3)), [
        'name' => 'form_update_question',
        'id' => 'form_update_question',
        'method' => 'POST'
      ]); ?>
      <?php $mcq_detail = get_mcq_detail($question_detail->question_id); ?>
      <div class="col-md-12">
        <div class="card-body">

          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Question</label>
            <div class="col-md-11">
              <textarea id="summernote" rows="6" cols="40"
                name="question"><?php echo $question_detail->question; ?> </textarea>
            </div>
          </div>
          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Explanation</label>
            <div class="col-md-11">
              <textarea id="explanation" rows="6" cols="40" name="explanation"><?php echo $question_detail->explanation; ?>
              </textarea>
            </div>
          </div>

          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Option 1</label>
            <div class="col-md-5">
              <textarea name="option_1" rows="2" cols="65"><?php echo $question_detail->option_1; ?></textarea>
            </div>
            <?php if ($mcq_detail->no_of_options == 2 || $mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
              <label for="inputProjectLeader" class="col-sm-1 control-label">Option 2</label>
              <div class="col-md-5">
                <textarea name="option_2" rows="2" cols="65"><?php echo $question_detail->option_2; ?></textarea>
              </div>
            <?php } ?>
          </div>
          <div class="row form-group">
            <?php if ($mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
              <label for="inputClientCompany" class="col-sm-1 control-label">Option 3</label>
              <div class="col-md-5">
                <textarea name="option_3" rows="2" cols="65"><?php echo $question_detail->option_3; ?></textarea>
              </div>
            <?php } ?>
            <?php if ($mcq_detail->no_of_options == 4) { ?>
              <label for="inputProjectLeader" class="col-sm-1 control-label">Option 4</label>
              <div class="col-md-5">
                <textarea name="option_4" rows="2" cols="65"><?php echo $question_detail->option_4; ?></textarea>
              </div>
            <?php } ?>
          </div>
          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Correct Option</label>
            <div class="col-md-5">
              <select class="form-control chosen chosen-select-deselect" name="correct_option" id="correct_option"
                data-placeholder="Select Correct option">
                <option value="">Correct Option</option>
                <option <?= 1 == $question_detail->correct_option ? 'selected' : ''; ?> value="1">Option 1</option>
                <?php if ($mcq_detail->no_of_options == 2 || $mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
                  <option <?= 2 == $question_detail->correct_option ? 'selected' : ''; ?> value="2">Option 2</option>
                <?php } ?>
                <?php if ($mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
                  <option <?= 3 == $question_detail->correct_option ? 'selected' : ''; ?> value="3">Option 3</option>
                <?php } ?>
                <?php if ($mcq_detail->no_of_options == 4) { ?>
                  <option <?= 4 == $question_detail->correct_option ? 'selected' : ''; ?> value="4">Option 4</option>
                <?php } ?>
              </select>
            </div>
          </div>
          <input type="hidden" name="question_id" value="<?php echo $question_detail->question_id; ?>">
          <!-- /.col -->
        </div>

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <input value="save" class="btn btn-success update_question">
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
    $('#summernote').summernote();
    $('#explanation').summernote();
    $('.update_question').click(function () {

      var form_update_question = $('#form_update_question');
      var data_post = form_update_question.serializeArray();
      $.ajax({
        url: form_update_question.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {
            showStatusMessage('success', 'Success', res.message);
            setTimeout(() => {
              window.location.href = res.redirect;
            }, 2000);

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