  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Study Material List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Study Material List </li>
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
              <a href="<?php echo base_url('study_materials/add')?>" type="btn"  class="btn btn-success float-right">Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Course Name</th>
                    <th>Chapter</th>
                    <th>Topic</th>
                    <th>Materials</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($material_list as $material){?>
                  <tr>
                    <td><?php echo $material->course_name;?></td>
                    <td><?php echo $material->chapter_name;?></td>
                    <td><?php echo $material->topic_name;?></td>
                    <td><img src="<?= base_url() . 'uploads/study_material/' . $material->materials; ?>" class="image-responsive" alt="image sp_course" title="image sp_course" width="40px"></td>
                    <td> <a href="<?= base_url('/study_material/edit/'.$material->id); ?>"  class="label-default btn-act-edit"><i class="fa fa-edit "></i> </a></td>
                  </tr>
                <?php }?>
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

        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
