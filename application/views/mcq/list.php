  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MCQ List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">MCQ List </li>
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
              <a href="<?php echo base_url('mcq/add')?>" type="btn"  class="btn btn-success float-right">Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Course</th>
                    <th>Chapter</th>
                    <th>Topic</th>
                    <th>No of Options</th>
                    <th>Questions</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($mcq_list as $mcq){
                          $questions = get_no_of_question($mcq->id);?>
                  <tr>
                    <td><?php echo $mcq->course_name?></td>
                    <td><?php echo $mcq->chapter_name;?></td>
                    <td><?php echo $mcq->topic_name?></td>
                    <td><?php echo $mcq->no_of_options?></td>
                    <td><?php echo $questions;?></td>
                    <td><a href="<?= base_url('/mcq/question/' . $mcq->id); ?>"  class="btn btn-flat btn-success btn_add_new"><i class="fa fa-plus"></i> Question </a>
                      <a href="<?= base_url('/mcq/edit/'.$mcq->id); ?>"  class="label-default btn-act-edit"><i class="fa fa-edit "></i> </a></td>
                  </tr>
                  <?php }?>
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

        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
