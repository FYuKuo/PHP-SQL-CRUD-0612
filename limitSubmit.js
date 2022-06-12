var limit = document.getElementById('limit');
var limit_form = document.getElementById('limit_form');

limit.addEventListener('change',function(){
    console.log('點到ㄌ');
    limit_form.submit();
})
