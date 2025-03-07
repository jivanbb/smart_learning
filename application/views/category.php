<div class="content-wrapper">
    <div class="page_container">
      <div class="box">
            <h3>Category (<?php echo sizeof($all_category); ?>) <a href="javascript:;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add New Category</a></h3>
             <div style="padding-top: 50px;padding-left:10px;padding-right:10px">
            <table class="table example">
            <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    foreach($all_category as $cat)
    {
    ?>
    <tr>
      <th scope="row"></th>
      <td><?php echo $i; ?></td>
      <td><?php echo $cat['name']; ?></td>
      <td><input type="checkbox" <?php if($cat['status']==1) {echo "checked"; } ?> name="status"></td>
      <td>
        <a href="<?php echo base_url().'index.php/school/delete_category/'.$cat['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
        <a href="<?php echo base_url().'index.php/school/edit_category/'.$cat['id'] ?>" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
      </td>
    </tr>
    <?php
    $i++;
    }
    ?>
  </tbody>
</table>
            </div>  
       </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Category</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url().'index.php/school/category' ?>" id="add_category"> 
            <div class="form-group">
                <label>Enter Category Name</label>
                <input type="text" name="name" class="form-control" id="category" placeholder="Enter Category Name">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </form>
    </div>
  </div>
  </div>
</div>