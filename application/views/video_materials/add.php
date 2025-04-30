<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Video Material List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Video List </li>
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
      <?= form_open(base_url('/video_materials/save_material/'), [
        'name' => 'form_create_video',
        'id' => 'form_create_video',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-8">
        <div class="card-body">
        <div class="row form-group">
            <label for="inputName" class="col-md-2">Course</label>
            <div class="col-md-4">
              <select class="form-control select2" name="course_id" style="width: 100%;" id="course_id">
                <option>Select Course</option>
                <?php foreach ($course_list as $course) { ?>
                  <option value="<?php echo $course->id; ?>"><?php echo $course->name; ?></option>
                <?php } ?>
              </select>
            </div>
            <label for="inputName" class="col-md-2">Chapter<i class="required">*</i></label>
            <div class="col-md-4">
            <select name="chapter_id" class="form-control" id="chapter_id">
              <option>Select Chapter</option>
            </select>
            </div>
          </div>

         
          <div class="form-group row">
            <label for="inputClientCompany" class="col-md-2">Topic </label>
            <div class="col-md-4">
            <select name="topic_id" class="form-control" id="topic_id">
              <option>Select Topic</option>

            </select>
            </div>
            <label for="inputClientCompany" class="col-md-2">Video Link </label>
            <div class="col-md-4">
              <input type="text" class="form-control" name="materials" placeholder="Video Link">
            </div>
          </div>

          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
        <input type="submit" value="save" class="btn btn-success create_video">
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
    $('.create_video').click(function () {
      var form_create_video = $('#form_create_video');
      var data_post = form_create_video.serializeArray();
      $.ajax({
        url: form_create_video.attr('action'),
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

    $('#course_id').change(function() {
            $('#chapter_id').empty();
            $('#topic_id').empty();
            var course_id = $(this).val();
            if (course_id !== '') {

                $.ajax({
                    type: 'GET',
                    data: course_id,
                    dataType: 'html',
                    url: BASE_URL + '/mcq/getChapter/' + course_id,
                    success: function(html) {
                        $('#chapter_id').html(html);
                    }
                });
            }
        });

        $('#chapter_id').change(function() {
            $('#topic_id').empty();
            var chapter_id = $(this).val();
            if (chapter_id !== '') {

                $.ajax({
                    type: 'GET',
                    data: chapter_id,
                    dataType: 'html',
                    url: BASE_URL + '/mcq/getTopic/' + chapter_id,
                    success: function(html) {
                        $('#topic_id').html(html);
                    }
                });

            }
        });
  });
</script>