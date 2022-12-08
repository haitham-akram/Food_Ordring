{{--form validation--}}
<script>
    let id = 0;
    $(document).on('click','#category_edit',function (e){
        id = $(this).attr('category_id');
    });
    function validateForm(event){
        let flag = true;
        let name_ar = document.forms['form'+id]['name_ar'].value;
        let name_en = document.forms['form'+id]['name_en'].value;
        if(name_en === ""){
            document.getElementById('error_name_en'+id).style.display = "inline";
            document.getElementById("name_en"+id).focus();
            var scrollDiv = document.getElementById("name_en"+id).offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_name_en'+id).style.display = "none";
        }
        if(name_ar === ""){
            document.getElementById('error_name_ar'+id).style.display = "inline";
            document.getElementById("name_ar"+id).focus();
            var scrollDiv = document.getElementById("name_ar"+id).offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_name_ar'+id).style.display = "none";
        }
        return flag;
    }
</script>
