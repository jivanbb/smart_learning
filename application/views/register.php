<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart Learning | Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>tools/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'tools/plugins/sweetalert2/sweetalert2.css' ?>">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html"><b>Smart Learning</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new user</p>
        <?= form_open('', [
          'name' => 'form_login',
          'id' => 'form_login',
          'method' => 'POST'
        ]); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="full_name" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-user"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text"></div> <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="phone" placeholder="Phone">
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-phone"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-control" name="role_id">
            <option>Select Role</option>
            <?php foreach (db_get_all_data('roles') as $row) { ?>
              <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
          </select>
          <div class="input-group-append">
            <div class="input-group-text"> <span class="fas fa-users"></span></div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span> </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirm_password" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button class="btn btn-primary btn-block add_member">Register</button>
          </div>
          <!-- /.col -->
        </div>
        <?= form_close(); ?>



        <a href="<?php echo base_url('auth/login') ?>" classadd_member="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url() ?>tools/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() ?>tools/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>tools/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url() ?>tools/plugins/sweetalert2/sweetalert2.js"></script>
  <script>
    $(document).ready(function () {
      $('.add_member').click(function () {

        var form_login = $('#form_login');
        var data_post = form_login.serializeArray();
        $.ajax({
          url: '<?php echo base_url() ?>' + '/auth/add_member',
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
  <script src="<?php echo base_url() ?>tools/js/custom.js"></script>
</body>

</html>