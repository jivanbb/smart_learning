<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit User </li>
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
      <div class="col-md-8">
        <div class="card-body">
          <div class="form-group">
            <label for="inputName">Full Name</label>
            <input type="text" id="inputName" name="full_name" class="form-control" placeholder="Full Name" value="<?php echo $user_detail->full_name?>">
          </div>
          <div class="form-group">
            <label for="inputName">Email</label>
            <input type="email" id="inputName" name="email" class="form-control" placeholder="Email" value="<?php echo $user_detail->email?>">
          </div>

         
          <div class="form-group">
            <label for="inputClientCompany">Address</label>
            <input type="text" id="inputClientCompany" class="form-control" placeholder="Address" value="<?php echo $user_detail->address?>">
          </div>
          <div class="form-group">
            <label for="inputProjectLeader">Phone No</label>
            <input type="number" id="inputProjectLeader" class="form-control" placeholder="Phone No" value="<?php echo $user_detail->phone_no?>">
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Education</label>
            <input type="text" id="inputClientCompany" class="form-control" placeholder="Education">
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Experience</label>
            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Skills</label>
            <textarea class="form-control" id="inputExperience" placeholder="Skills"></textarea>
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Description</label>
            <textarea class="form-control" id="inputExperience" placeholder="Description"></textarea>
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Role</label>
            <input type="text" id="inputClientCompany" class="form-control" placeholder="Education">
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
        <input type="submit" value="edit" class="btn btn-success">
          <a href="#" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->