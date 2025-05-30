<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Chapter List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Chapter List </li>
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
              <button type="button" class="btn btn-flat btn-success btn_add_new float-right" data-toggle="modal"
                data-target="#new_chapter"><i class="fa fa-plus"></i> Create</button>
            </div>
            <!-- /.card-header -->
            <?= form_open(base_url('chapter/edit_chapter'), [
              'name' => 'form_chapter_update',
              'class' => 'form-horizontal',
              'id' => 'form_chapter_update',
              'enctype' => 'multipart/form-data',
              'method' => 'POST',
            ]); ?>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>SN.</th>
                    <th>Course Name</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sn = 0;
                  foreach ($chapter_list as $chapter) {
                    $sn++; ?>
                    <tr>
                      <td><?php echo $sn; ?></td>
                      <td><span class="value"><?php echo $chapter->course_name; ?></span><span class="input hidden">
                          <select name="group[<?php echo $chapter->id; ?>][course_id]" class="form-control" disabled>
                            <option>Select Course</option>
                            <?php foreach (db_get_all_data('courses') as $row) { ?>
                              <option <?php if($chapter->course_id ==$row->id){ echo 'selected';}?> value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                            <?php } ?>
                          </select>
                        </span></td>
                      <td><span class="value"><?= $chapter->name; ?></span><span class="input hidden"><input type="text"
                            class="form-control" name="group[<?php echo $chapter->id; ?>][name]"
                            value="<?php echo $chapter->name; ?>" disabled="disabled"></span></td>
                      <td> <a href="#" class="edit-inline"><i class="fa fa-edit"></i></a></td>
                    </tr>
                  <?php } ?>
                  </tr>
                </tbody>
              </table>
              <div class="col-md-12 mt-10p">
                <div class="row">
                  <div class="col-xs-6 p-0">
                    <button type="submit" class="btn  btn-primary update_chapter" id="btn_edit">Edit
                    </button>
                    <button href="#" id="btn_cancel"
                      class='  btn-red cancel-edit-inline btn btn-flat btn-default btn_action' title="Cancel">
                      Cancel</button>
                  </div>

                </div>
              </div>
            </div>
            <?= form_close(); ?>
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
<div id="new_chapter" class="modal fade new-july-design" chapter="dialog">

  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create chapter</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body new-july-design">
        <?= form_open(base_url('chapter/save_chapter'), [
          'name' => 'form_chapter_add',
          'class' => 'form-horizontal',
          'id' => 'form_chapter_add',
          'enctype' => 'multipart/form-data',
          'method' => 'POST'
        ]); ?>
        <div class="form-group group-name ">
          <label for="name" class="col-sm-4 control-label"> Course<i class="required">*</i>
          </label>
          <div class="col-sm-8">
            <select name="course_id" class="form-control">
              <option>Select Course</option>
              <?php foreach (db_get_all_data('courses') as $row) { ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group group-name ">
          <label for="name" class="col-sm-4 control-label"> Name<i class="required">*</i>
          </label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" placeholder=" Name"
              value="<?= set_value('name'); ?>">
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

    $('.edit-inline').on('click', function (e) {
      e.preventDefault();
      var parentRow = $(this).parents('tr');
      $('td span.value', parentRow).addClass('hidden');
      $('td span.input', parentRow).removeClass('hidden');
      $('td span :input', parentRow).prop('disabled', false);
    });

    $('.remove-data').click(function () {
      var url = $(this).attr('data-href');
      showDeleteMessage(url);
      return false;
    });

    $('.cancel-edit-inline').on('click', function (e) {
      var url = BASE_URL + 'permission';
      showCancelMessage(url);
      return false;
    });


    $('.update_chapter').click(function () {
      $('.message').fadeOut();

      var form_chapter_update = $('#form_chapter_update');
      var data_post = form_chapter_update.serializeArray();
      var save_type = $(this).attr('data-stype');
      data_post.push({
        name: 'save_type',
        value: save_type
      });

      $('.loading').show();

      $.ajax({
        url: form_chapter_update.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {

            showStatusMessage('success', 'Success', res.message);
            $('.edit-inline').each(function () {
              var parentRow = $(this).parents('tr');
              var td = $('td', parentRow);
              td.each(function () {
                $('span.value', this).removeClass('hidden');
                var input = $('span.input :input', this);
                var text = input.val();
                if (input.is("select")) {
                  text = $('option:selected', input).text();
                }
                $('span.value', this).text(text);
                $('span.input', this).addClass('hidden');
                $('span :input', this).prop('disabled', true);
              });
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
    $('.btn_save').click(function () {
      var form_chapter_add = $('#form_chapter_add');
      var data_post = form_chapter_add.serializeArray();
      $.ajax({
        url: form_chapter_add.attr('action'),
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