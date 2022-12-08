{{--form validation--}}
<script>
    function validateForm(){
        let flag = true;
        let name_ar = document.forms['create_form']['name_ar'].value;
        let name_en = document.forms['create_form']['name_en'].value;
        let description_ar = document.forms['create_form']['description_ar'].value;
        let description_en = document.forms['create_form']['description_en'].value;
        let category = document.forms['create_form']['category_id[]'];
        let latitude = document.getElementById('latitude').value;
        let longitude = document.getElementById('longitude').value;
        if(longitude === ""){
            document.getElementById('error_longitude').style.display = "inline";
            document.getElementById("longitude").focus();
            var scrollDiv = document.getElementById("longitude").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_longitude').style.display = "none";
        }
        if(latitude === ""){
            document.getElementById('error_latitude').style.display = "inline";
            document.getElementById("latitude").focus();
            var scrollDiv = document.getElementById("latitude").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_latitude').style.display = "none";
        }
        let array = [];
        for (var i = 0; i < category.length; i++) {
            var a = category[i];
            array[i]=a.selected;
        }
        if(array.every(a=> a === false)){
            document.getElementById('error_category').style.display = "inline";
            document.getElementById("category").focus();
            var scrollDiv = document.getElementById("category").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_category').style.display = "none";
        }
        if(description_en == ""){
            document.getElementById('error_description_en').style.display = "inline";
            document.getElementById("description_en").focus();
            var scrollDiv = document.getElementById("description_en").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_description_en').style.display = "none";
        }
        if(description_ar == ""){
            document.getElementById('error_description_ar').style.display = "inline";
            document.getElementById("description_ar").focus();
            var scrollDiv = document.getElementById("description_ar").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_description_ar').style.display = "none";
        }
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

