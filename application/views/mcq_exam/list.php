<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">MCQ Exam</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">MCQ Exam </li>
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
      <form name="form_sq_mcq_exam" id="form_sq_mcq_exam" action="<?= base_url('/mcq_exam/index'); ?>">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-10" style="display:flex">
                    <div class="col-sm-2 padd-left-0 ">
                      <select class="form-control chosen chosen-select" name="teacher" id="teacher"
                        data-placeholder="Teacher">
                        <option value="">Teacher</option>
                        <?php foreach ($teachers as $teacher) { ?>
                          <option <?= $teacher->id == @$filter['teacher'] ? 'selected' : ''; ?>
                            value="<?php echo $teacher->id; ?>">
                            <?php echo $teacher->full_name ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-2 padd-left-0 ">
                      <select class="form-control " name="course_id" id="course_id" data-placeholder="Course">
                        <option value="">Course</option>
                        <?php if (@$filter['course_id']) {
                          $courses = $this->mcq_exam_model->getCourseByTeacher(@$filter['teacher']);
                          foreach ($courses as $course) { ?>
                            <option <?= $course->id == @$filter['course_id'] ? 'selected' : ''; ?>
                              value="<?php echo $course->id; ?>">
                              <?php echo $course->name ?>
                            </option>
                          <?php }
                        } ?>
                      </select>
                    </div>
                    <div class="col-sm-1 padd-left-0 ">
                      <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply"
                        title="Filter">Filter
                      </button>
                    </div>
                    <div class="col-sm-1 padd-left-0 ">
                      <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply"
                        href="<?= base_url('/mcq_exam'); ?>" title="Reset">
                        <i class="fa fa-undo"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>

                        <th>Course</th>
                        <th> No of Questions</th>
                        <th>Full Marks</th>
                        <th>Pass Mark</th>
                        <th>Time</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($mcq_list as $mcq) { ?>
                        <tr>
                          <td><?php echo $mcq->course_name; ?></td>
                          <td><?php echo $mcq->total_questions; ?></td>
                          <td><?php echo $mcq->full_marks; ?></td>
                          <td><?php echo $mcq->pass_marks; ?></td>
                          <td><?php echo $mcq->time; ?></td>
                          <td> <a href="<?= base_url('/mcq_exam/start_exam/' . $mcq->id); ?>"
                              class="btn btn-flat btn-success btn_add_new"><i class="fa fa-book "></i> </a></td>
                        </tr>
                      <?php } ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        </div>
      </form>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  $(document).ready(function () {
    $('#teacher').change(function () {
      var teacher = $(this).val();
      if (teacher !== '') {

        $.ajax({
          type: 'GET',
          data: teacher,
          dataType: 'html',
          url: BASE_URL + 'mcq_exam/getCourse/' + teacher,
          success: function (html) {
            $('#course_id').html(html);
          }
        });
      }
    });

  });
</script>