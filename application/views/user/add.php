<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create User </li>
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
      <?= form_open('', [
        'name'    => 'form_create_user',
        'id'      => 'form_create_user',
        'method'  => 'POST'
      ]); ?>
      <div class="col-md-8">
        <div class="card-body">

          <div class="form-group">
            <label for="inputName">Full Name</label>
            <input type="text" id="inputName" name="full_name" class="form-control" placeholder="Full Name">
          </div>
          <div class="form-group">
            <label for="inputName">Email</label>
            <input type="email" id="inputName" name="email" class="form-control" placeholder="Email">
          </div>

         
          <div class="form-group">
            <label for="inputClientCompany">Address</label>
            <input type="text" id="inputClientCompany" name="address" class="form-control" placeholder="Address">
          </div>
          <div class="form-group">
            <label for="inputProjectLeader">Phone No</label>
            <input type="number" id="inputProjectLeader" name="phone_no" class="form-control" placeholder="Phone No">
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Education</label>
            <input type="text" id="inputClientCompany" name="education" class="form-control" placeholder="Education">
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Experience</label>
            <textarea class="form-control" id="inputExperience" name="experience" placeholder="Experience"></textarea>
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Skills</label>
            <textarea class="form-control" id="inputExperience" name="skills" placeholder="Skills"></textarea>
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Description</label>
            <textarea class="form-control" id="inputExperience" name="description" placeholder="DEscription"></textarea>
          </div>
          <div class="form-group">
            <label for="inputClientCompany">Role</label>
           <select name="role" class="form-control">
            <option>Select Role</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
           </select>
          </div>
          <!-- /.col -->
        </div>
      
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
        <input  value="save" class="btn btn-success save_user">
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
   $(document).ready(function() {
      $('.save_user').click(function() {

            var form_create_user = $('#form_create_user');
            var data_post = form_create_user.serializeArray();
            $.ajax({
                    url: '<?php echo base_url() ?>'+'/admin/save_user',
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                })
                .done(function(res) {
                    if (res.success) {
                        showStatusMessage('success', 'Success', res.message);
                        setTimeout(() => {
                            window.location.reload(true);
                        });

                    } else {
                        showValidationMessage(`${res.message}`);
                    }

                })
                .fail(function() {
                    showStatusMessage('error', 'Error', 'Error save data');
                })
                .always(function() {
                    $('.loading').hide();
                    $('html, body').animate({
                        scrollTop: $(document).height()
                    }, 2000);
                });

            return false;
        }); /*end btn save*/
      });
 </script>