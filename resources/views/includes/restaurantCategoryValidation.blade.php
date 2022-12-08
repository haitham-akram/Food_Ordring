
{{--form validation--}}
<script>
    function validateForm(event){
        // event.preventDefault();
        let flag = true;
        let name_ar = document.forms['create_form']['name_ar'].value;
        let name_en = document.forms['create_form']['name_en'].value;
        if(name_en == ""){
            document.getElementById('error_name_en').style.display = "inline";
            document.getElementById("name_en").focus();
            var scrollDiv = document.getElementById("name_en").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_name_en').style.display = "none";
        }
        if(name_ar == ""){
            document.getElementById('error_name_ar').style.display = "inline";
            document.getElementById("name_ar").focus();
            var scrollDiv = document.getElementById("name_ar").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_name_ar').style.display = "none";
        }
        return flag;
    }
</script>
