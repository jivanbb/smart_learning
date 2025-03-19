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
      <?= form_open(base_url('/admin/update_user/' . $this->uri->segment(3)), [
        'name' => 'form_update_user',
        'id' => 'form_update_user',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-12">
        <div class="card-body">
          <div class="row form-group">
            <label for="inputName" class="col-sm-1 control-label">Full Name</label>
            <div class="col-sm-5">
              <input type="text" id="inputName" name="full_name" class="form-control" placeholder="Full Name"
                value="<?php echo $user_detail->full_name ?>">
            </div>
            <label for="inputName" class="col-sm-1 control-label">Email</label>
            <div class="col-sm-5">
              <input type="email" id="inputName" name="email" class="form-control" placeholder="Email"
                value="<?php echo $user_detail->email ?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Address</label>
            <div class="col-sm-5">
              <input type="text" id="inputClientCompany" name="address" class="form-control" placeholder="Address"
                value="<?php echo $user_detail->address ?>">
            </div>
            <label for="inputProjectLeader" class="col-sm-1 control-label">Phone No</label>
            <div class="col-sm-5">
              <input type="number" id="inputProjectLeader" name="phone_no" class="form-control" placeholder="Phone No"
                value="<?php echo $user_detail->phone_no ?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Education</label>
            <div class="col-sm-5">
              <input type="text" id="inputClientCompany" name="education" class="form-control" placeholder="Education"
                value="<?php echo $user_detail->education; ?>">
            </div>
            <label for="inputClientCompany" class="col-sm-1 control-label">Experience</label>
            <div class="col-sm-5">
            <textarea class="form-control" id="inputExperience" name="experience"
              placeholder="Experience"><?php echo $user_detail->experience; ?></textarea>
              </div>
          </div>
          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Skills</label>
            <div class="col-sm-11">
            <textarea class="form-control" id="inputExperience" name="skills"
              placeholder="Skills"><?php echo $user_detail->skills; ?></textarea>
              </div>
          </div>
          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Description</label>
            <div class="col-sm-11">
            <textarea class="form-control" id="inputExperience" name="description"
              placeholder="Description"><?php echo $user_detail->description; ?></textarea>
              </div>
          </div>
          <div class="row form-group">
            <label for="inputClientCompany" class="col-sm-1 control-label">Role</label>
            <div class="col-sm-5">
            <input type="text" id="inputClientCompany" class="form-control" placeholder="Education">
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <?= form_close(); ?>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <input  value="edit" class="btn btn-success update_user">
          <a href="#" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  $(document).ready(function () {
    $('.update_user').click(function () {

      var form_update_user = $('#form_update_user');
      var data_post = form_update_user.serializeArray();
      $.ajax({
        url: form_update_user.attr('action'),
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