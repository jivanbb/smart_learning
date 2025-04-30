<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Result Datail</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Result Detail</li>
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
              <div class="row">
              <div class="col-md-4">
                <div class="form-group ">
                  <label for="content" class="col-sm-3 control-label">Course: </label>

                  <div class="col-sm-9">
                    <?php echo $exam_detail->course_name; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group ">
                  <label for="content" class="col-sm-5 control-label">Creator Name: </label>

                  <div class="col-sm-7">
                    <span class="detail_group-no_of_options"><?= _ent($exam_detail->full_name); ?></span>
                  </div>
                </div>
              </div>
            </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr class="">
                      <th data-field="sn" data-sort="1" data-primary-key="0"> SN</th>
                      <th data-field="course_id" data-sort="1" data-primary-key="0"> Exam Date</th>
                      <th data-field="creator_name" data-sort="1" data-primary-key="0"> Start Time</th>
                      <th data-field="amount" data-sort="1" data-primary-key="0"> Submitted Time</th>
                      <th>Time Taken</th>
                      <th>Total Question</th>
                      <th>Score</th>
                      <th>Rank</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $sn = 0;
                    foreach ($result_detail as $res) {
                      $rank = get_student_rank($res->exam_id, $user_id, $res->id);
                      $sn++; ?>
                      <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $res->created_at; ?></td>
                        <td><?php echo $res->start_time; ?></td>
                        <td><?php echo $res->submitted_time; ?></td>
                        <td><?php echo $res->time_taken; ?></td>
                        <td><?php echo $exam_detail->total_questions; ?></td>
                        <td><?php echo $res->score; ?></td>
                        <td><?php echo $rank . ' / ' . $total_user ?> </td>
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
