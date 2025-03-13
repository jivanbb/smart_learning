<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Course List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Course List </li>
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
            <label for="inputName">Board/University</label>
            <select class="form-control select2"  style="width: 100%;">
              <option selected="selected">Pokhara University</option>
              <option>TU</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputName">Course Name</label>
            <input type="text" id="inputName" class="form-control">
          </div>

         
          <div class="form-group">
            <label for="inputClientCompany">Amount</label>
            <input type="text" id="inputClientCompany" class="form-control">
          </div>
          <div class="form-group">
            <label for="inputProjectLeader">Valid Days</label>
            <input type="text" id="inputProjectLeader" class="form-control">
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