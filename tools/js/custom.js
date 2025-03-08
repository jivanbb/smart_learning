$('add_category').submit(function(){
    category=$('#category').val();
    
    url=$(this).attr('action');
    $.post(url,{'name':category},function(fb){
        if(fb.match('1'))
        {
            alert('Category Successfully Added');
            setTimeout(function(){
                location.reload();
            },2000);
        }
        else
        {
            alert(fb)
        }
    });
    return false;
});

$('#update_sub_cat').submit(function(){
    name=$('#name').val();
    url=$(this).attr('action');
    $.post(url,{'name':name},function(fb){
        if(fb.match('1'))
        {
            alert('Category Successfully Updated');
            setTimeout(function(){
                window.location.href=BASE_URL+"index.php/school/category";
            },2000);
        }
        else
        {
            alert('Category Not Updated')
        }
    });
    return false;
});