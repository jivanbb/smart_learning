<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Permission</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Permission </li>
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
      <?= form_open(base_url('/permission/save_permission'), [
        'name' => 'form_create_permission',
        'id' => 'form_create_permission',
        'method' => 'POST'
      ]); ?>
      <div class="col-md-8">
        <div class="card-body">
          <div class="form-group">
            <label for="inputName">Role</label>
            <select class="form-control select2" name="role_id" style="width: 100%;">
              <option>Select Role</option>
              <?php foreach ($role_list as $role) { ?>
                <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
              <?php } ?>
            </select>
          </div>
          <?php
          $arr = array();
          if (!empty($modules) && is_array($modules)) {
            foreach ($modules as $key => $value) {
              $arr[] = $value->name;
            }
          }
          $add_array = $arr;
          $edit_array = $arr;
          $delete_array = $arr;
          $list_array = $arr;
          ?>
          <div class="table-responsive">
            <table id="role_management" class="table table-bordered table-striped dataTable">
              <thead>
                <tr class="">
                  <th><input type="checkbox" class="check_all"> S.No.</th>
                  <th>Module</th>
                  <th>Add</th>
                  <th>List</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody id="tbody_oms_documents">
                <?php
                $i = 0;
                if (!empty($modules) && is_array($modules)) {
                  foreach ($modules as $module) {

                    ?>
                    <tr>
                      <td><input type="checkbox" class="check_row parent_<?php echo $module->id; ?>"
                          onchange="parentChanged(<?php echo $module->id; ?>)"></td>
                      <td><?php echo $module->name; ?></td>
                      <td>
                        <input type="checkbox" name="permission[<?php echo $module->id; ?>][add]" <?php
                           echo check_enable_or_not($add_array, $module->name); ?> value="1" class="check_one">
                      </td>
                      <td><input type="checkbox" name="permission[<?php echo $module->id; ?>][list]" <?php echo check_enable_or_not($list_array, $module->name); ?> value="1" class="check_one"></td>
                      <td> <input type="checkbox" name="permission[<?php echo $module->id; ?>][edit]" <?php echo check_enable_or_not($edit_array, $module->name); ?> value='1' class="check_one"> </td>
                      <td><input type="checkbox" name="permission[<?php echo $module->id; ?>][delete]" <?php echo check_enable_or_not($delete_array, $module->name); ?> value='1' class="check_one"> </td>
                    </tr>
                    <?php getSubmodule($module->sub, $modules); ?>
                    <?php
                    $i++;
                  }
                } ?>
              </tbody>
            </table>
          </div>
          <br>
          <button type="submit" class="btn btn-primary mr-2 create_permission">Submit</button>
          <button class="btn btn-light btn_cancel">Cancel</button>
          <!-- /.col -->
        </div>
      </div>

      <?= form_close(); ?>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
function getSubmodule($sub_group, $modules, $sub_mark = '-')
{
  $arr = array();
  foreach ($modules as $key => $value) {
    $arr[] = $value->name;
  }
  $add_array = $arr;
  $edit_array = $arr;
  $list_array = $arr;
  $delete_array = $arr;
  foreach ($sub_group as $key => $data) {
    $use = '<tr>';
    $use .= '<td><input type="checkbox" class="check_row child_' . $data->parent_id . ' parent_' . $data->id . ' " onchange="childChanged(' . $data->parent_id . ',' . $data->id . ')"></td>';
    $use .= '<td value="' . $data->id . '">  &nbsp; &nbsp; &nbsp; &nbsp; ' . $sub_mark . ' ' . $data->name . '</td>';
    $use .= '<td><input type="checkbox" name="permission[' . $data->id . '][add]"
								value = "1" class="check_one"></td>';
    $use .= '<td><input type="checkbox" name="permission[' . $data->id . '][list]"  
								value="1" class="check_one"></td>';
    $use .= '<td><input type="checkbox" name="permission[' . $data->id . '][edit]" 
								value="1" class="check_one"></td>';

    $use .= '<td><input type="checkbox" name="permission[' . $data->id . '][delete]"  
								value="1" class="check_one"></td>';

    $use .= '</tr>';
    echo $use;
    getSubmodule($data->sub, $modules, $sub_mark . ' - ');
  }
} ?>
<script>
  $(document).ready(function () {
    check_row_option();
    // check_child_option();
    check_all_option();
    $('.check_all').on('click', function () {
      if ($(this).is(':checked')) {
        $('#role_management input[type="checkbox"]').not("[disabled]").prop('checked', true);
      } else {
        $('#role_management input[type="checkbox"]').not("[disabled]").prop('checked', false);
      }
    });


    $('#role_management').on('click', '.check_row', function () {
      if ($(this).is(':checked')) {
        $(this).closest('tr').find('input[type="checkbox"]').not("[disabled]").prop('checked', true);
      } else {
        $(this).closest('tr').find('input[type="checkbox"]').not("[disabled]").prop('checked', false);
      }
      check_all_option();
    });



    $('#role_management').on('click', '.check_one', function () {
      var parent = $(this).closest('tr');
      if ($(this).is(':checked')) {
        var rowcount = 0;
        var check_one_length = parent.find('.check_one:enabled').length;
        parent.find('.check_one:enabled').each(function () {
          if ($(this).is(':checked')) {
            rowcount = rowcount + 1;
          } else {
            parent.find('.check_row').prop('checked', false);
          }
        });

        if (rowcount == check_one_length) {
          parent.find('.check_row').prop('checked', true);
        }
      } else {
        parent.find('.check_row').prop('checked', false);
      }
      check_all_option();
    });
    $('.create_permission').click(function () {
      var form_create_permission = $('#form_create_permission');
      var data_post = form_create_permission.serializeArray();
      $.ajax({
        url: form_create_permission.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data_post,
      })
        .done(function (res) {
          if (res.success) {
            showStatusMessage('success', 'Success', res.message);
            setTimeout(() => {
              window.location.href = res.redirect;
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

  function check_all_option() {
    var count = 0;
    var check_length = $('.check_row').length;
    $('.check_row').each(function (index, element) {
      if (!$(this).is(':checked')) {
        $('.check_all').prop('checked', false);
        return;
      } else {
        count = count + 1;
      }
      if (count == check_length) {
        $('.check_all').prop('checked', true);
      }
    });
  }


  function check_row_option() {
    $('#role_management tbody tr').each(function () {
      var count = 0;
      var check_length = $(this).find('.check_one:enabled').length;
      var parent = $(this);
      parent.find('.check_one:enabled').each(function () {
        if ($(this).is(':checked')) {
          count = count + 1;
        } else {
          parent.find('.check_row').prop('checked', false);
        }
      });
      if (count == check_length) {
        parent.find('.check_row').prop('checked', true);
      }
    });
  }
  function parentChanged(parent_id) {
					if ($('.parent_' + parent_id).is(":checked") === true) {
						$('.child_' + parent_id).each(function(index) {
							const parentID = $(this).attr('class');
							const classTrim = parentID.split(' ');
							const parentTrimed = classTrim[2].split('_');
							const parentIDs = parentTrimed[1];
							$('.child_' + parentIDs).prop("checked", true);
							$('.child_' + parentIDs).closest('tr').find('input[type="checkbox"]').prop('checked', true);
						});

						$('.child_' + parent_id).prop("checked", true);
						$('.child_' + parent_id).closest('tr').find('input[type="checkbox"]').prop('checked', true);
					} else {
						$('.child_' + parent_id).each(function(index) {
							const parentID = $(this).attr('class');
							const classTrim = parentID.split(' ');
							const parentTrimed = classTrim[2].split('_');
							const parentIDs = parentTrimed[1];
							$('.child_' + parentIDs).prop("checked", false);
							$('.child_' + parentIDs).closest('tr').find('input[type="checkbox"]').prop('checked', false);
						});
						$('.child_' + parent_id).prop("checked", false);
						$('.child_' + parent_id).closest('tr').find('input[type="checkbox"]').prop('checked', false);
					}
				}

				function childChanged(parent_id, child_id) {
					if ($('.child_' + parent_id).is(":checked") === true) {
						$('.parent_' + parent_id).prop("checked", true);
						$('.parent_' + parent_id).closest('tr').find('input[type="checkbox"]').prop('checked', true);
						$('.child_' + child_id).closest('tr').find('input[type="checkbox"]').prop('checked', true);
					} else {
						$('.child_' + parent_id).each(function(index) {
							const parentID = $(this).attr('class');
							const classTrim = parentID.split(' ');
							const parentTrimed = classTrim[2].split('_');
							const parentIDs = parentTrimed[1];
							$('.child_' + parentIDs).prop("checked", false);
							$('.child_' + parentIDs).closest('tr').find('input[type="checkbox"]').prop('checked', false);
						});
						$('.parent_' + parent_id).prop("checked", false);
						$('.parent_' + parent_id).closest('tr').find('input[type="checkbox"]').prop('checked', false);
					}
				}
</script>