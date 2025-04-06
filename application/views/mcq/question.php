<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Question</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Question </li>
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
      <?= form_open(base_url('/mcq/save_question/' . $this->uri->segment(3)), [
        'name' => 'form_create_question',
        'id' => 'form_create_question',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-12">
        <div class="card-body">

          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Question</label>
            <div class="col-md-11">
              <textarea id="summernote" rows="6" cols="40" name="question">

              </textarea>
            </div>
          </div>
          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Explanation</label>
            <div class="col-md-11">
              <textarea id="explanation" rows="6" cols="40" name="explanation">

              </textarea>
            </div>
          </div>

          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Option 1</label>
            <div class="col-md-5">
              <textarea name="option_1" rows="2" cols="65"></textarea>
            </div>
            <?php if ($mcq_detail->no_of_options == 2 || $mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
              <label for="inputProjectLeader" class="col-sm-1 control-label">Option 2</label>
              <div class="col-md-5">
                <textarea name="option_2" rows="2" cols="65"></textarea>
              </div>
            <?php } ?>
          </div>
          <div class="row form-group">
            <?php if ($mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
              <label for="inputClientCompany" class="col-sm-1 control-label">Option 3</label>
              <div class="col-md-5">
                <textarea name="option_3" rows="2" cols="65"></textarea>
              </div>
            <?php } ?>
            <?php if ($mcq_detail->no_of_options == 4) { ?>
              <label for="inputProjectLeader" class="col-sm-1 control-label">Option 4</label>
              <div class="col-md-5">
                <textarea name="option_4" rows="2" cols="65"></textarea>
              </div>
            <?php } ?>
          </div>
          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Correct Option</label>
            <div class="col-md-5">
              <select class="form-control chosen chosen-select-deselect" name="correct_option" id="correct_option"
                data-placeholder="Select Correct option">
                <option value="">Correct Option</option>
                <option value="1">Option 1</option>
                <?php if ($mcq_detail->no_of_options == 2 || $mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
                  <option value="2">Option 2</option>
                <?php } ?>
                <?php if ($mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
                  <option value="3">Option 3</option>
                <?php } ?>
                <?php if ($mcq_detail->no_of_options == 4) { ?>
                  <option value="4">Option 4</option>
                <?php } ?>
              </select>
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
      <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr class="">
                                            <th>SN</th>
                                            <th>Question</th>
                                            <th >Option 1</th>
                                            <?php if ($mcq_detail->no_of_options == 2 || $mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
                                                <th> Option 2</th>
                                            <?php } ?>
                                            <?php if ($mcq_detail->no_of_options == 3 || $mcq_detail->no_of_options == 4) { ?>
                                                <th > Option 3</th>
                                            <?php } ?>
                                            <?php if ($mcq_detail->no_of_options == 4) { ?>
                                                <th > Option 4</th>
                                            <?php } ?>
                                            <th > Correct Option</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 0;
                                        foreach ($question_detail as $question) {
                                            $sn++; ?>
                                            <tr>
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $question->question; ?></td>
                                                <td><?php echo $question->option_1; ?></td>
                                                <td><?php echo $question->option_2; ?></td>
                                                <td><?php echo $question->option_3; ?></td>
                                                <td><?php echo $question->option_4; ?></td>
                                                <td><?php echo $question->correct_option; ?></td>
                                                <td> <a href="<?= base_url('/mcq/question_edit/' . $question->id); ?>" data-id="<?= $question->id ?>" class="label-default btn-act-edit"><i class="fa fa-edit "></i> </a>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
    $('#summernote').summernote();
    $('#explanation').summernote();
    $('.create_user').click(function () {

      var form_create_question = $('#form_create_question');
      var data_post = form_create_question.serializeArray();
      $.ajax({
        url: form_create_question.attr('action'),
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