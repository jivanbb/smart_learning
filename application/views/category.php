<div class="content-wrapper">
    <div class="page_container">
      <div class="box">
        <div style="padding-top: 50px;padding-left:10px;padding-right:10px">
            <h3>Category (2) <a href="javascript:;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add New Category</a></h3>
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
    <tr>
      <th scope="row">1</th>
      <td>Middle</td>
      <td><input type="checkbox" name="status"></td>
      <td>
        <a href="javascript:;" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
        <a href="javascript:;" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
      </td>
    </tr>
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