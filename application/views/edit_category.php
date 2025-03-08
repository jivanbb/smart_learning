<div class="content-wrapper">
    <div class="page_container">
        <div class="box">
            <h3>Edit Category</h3>
             <div style="padding-top: 50px;padding-left:10px;padding-right:10px">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <form action="<?php echo base_url().'index.php/school/edit_category/'.$cat_info[0]['name'] ?>" id="update_sub_cat">
                    <div class="col-sm-6">
                        <div class="from-group">
                            <label>Category Name</label>
                            <input type="text" name="name" id="name" value="<?php echo $cat_info[0]['name']; ?>" placeholder="Enter Category Name" class="form-control" />
                        </div><br>
                        <div class="from-group">
                            <input class="btn btn-primary" type="submit" value="Update" />
                        </div><br>
                    </div>
                </div>     
             </div>
         </div>
    </div>
</div>
