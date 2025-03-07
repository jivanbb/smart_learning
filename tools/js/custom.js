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