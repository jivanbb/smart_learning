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
      <div class="col-md-12">
        <div class="card-body">
          <?php $id = $this->uri->segment(3); ?>
          <?= form_open(base_url('/mcq_setup/edit_mcq/' . $id), [
            'name' => 'form_edit_mcq',
            'id' => 'form_edit_mcq',
            'method' => 'POST'
          ]); ?>
          <div class="row form-group">
            <label for="inputName" class="col-sm-2 control-label">Course</label>
            <div class="col-md-4">
              <select class="form-control select2" name="course_id" style="width: 100%;">
                <?php foreach (db_get_all_data('courses') as $row) { ?>
                  <option <?php if ($row->id == $mcq_detail->course_id) {
                    echo 'selected';
                  } ?>
                    value="<?php echo $row->id ?>"><?php echo $row->name; ?></option>
                <?php } ?>
              </select>
            </div>
            <label for="inputName" class="col-sm-2 control-label">Time(In Min) <i class="required">*</i></label>
            <div class="col-md-4">
              <input type="number" id="inputName" name="time" class="form-control" value="<?php echo $mcq_detail->time;?>">
            </div>
          </div>
          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-2 control-label">Full Marks <i class="required">*</i></label>
            <div class="col-md-4">
            <input type="text" id="inputClientCompany" name="full_marks" class="form-control" value="<?php echo $mcq_detail->full_marks?>">
            </div>
            <label for="inputClientCompany" class="col-sm-2 control-label">Pass Marks <i class="required">*</i></label>
            <div class="col-md-4">
            <input type="text" id="inputClientCompany" name="pass_marks" class="form-control" value="<?php echo $mcq_detail->pass_marks;?>">
            </div>
          </div>
          <div class="row form-group group-marks ">
			<label for="no_of_options" class="col-sm-2 control-label">Marks <i class="required">*</i>
			</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" name="marks" placeholder="Marks" value="<?php echo $mcq_detail->question_marks;?>">
				<small class="info help-block">(Each question marks)
				</small>
			</div>
			<label for="set" class="col-sm-2 control-label">Negative Marking <i class="required">*</i>
			</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" name="negative_marking" placeholder="Negative Marking" value="<?php echo $mcq_detail->negative_marking;?>">
				<small class="info help-block">(percent)
				</small>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="dt-responsive table-responsive col-md-10">
				<table class="table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th>SN.</th>
							<th>Chapter Name</th>
							<th width="20%">No of Question</th>
						</tr>
					</thead>
					<tbody>
          <?php $sn =0;
                                         foreach ($mcq_exam_detail as $data) { 
                                            $sn++;?>
                                            <tr>
                                                <td><?php echo $sn;?></td>
                                                <td><?php echo $data->chapter_name;?></td>
                                                <td><input type="text" class="form-control" value="<?php echo $data->no_of_question;?>" name="chapter_data[<?php echo $data->chapter_id; ?>][no_of_questions]"></td>
                                            </tr>
                                        <?php } ?>
					</tbody>
				</table>
			</div>
		</div>

          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <input value="edit" class="btn btn-success update_mcq">
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
    $('.update_mcq').click(function () {

      var form_edit_mcq = $('#form_edit_mcq');
      var data_post = form_edit_mcq.serializeArray();
      $.ajax({
        url: form_edit_mcq.attr('action'),
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