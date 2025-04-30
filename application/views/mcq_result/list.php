<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Exam Result</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Exam Result</li>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Course</th>
                      <th>Full Marks</th>
                      <th>Attempts</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sn=0;
                    foreach ($exam_list as $res) {
                      $sn++;
                      $attempts = get_exam_attempts($user_id, $res->exam_id); ?>
                      <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $res->course_name; ?></td>
                        <td><?php echo $res->full_marks; ?></td>
                        <td><?php echo $attempts; ?></td>
                        <td><a href="<?= base_url('/mcq_result/result_detail/' . $res->exam_id); ?>"><i
                              class="fa fa-eye"></i> </a> </td>
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