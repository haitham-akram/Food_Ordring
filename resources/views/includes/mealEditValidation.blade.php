{{--form validation--}}
<script>
    function validateForm(event){
        let flag = true;
        let name_ar = document.forms['edit_form']['name_ar'].value;
        let name_en = document.forms['edit_form']['name_en'].value;
        let description_ar = document.forms['edit_form']['description_ar'].value;
        let description_en = document.forms['edit_form']['description_en'].value;
        let price = document.forms['edit_form']['price'].value;
        price = parseFloat(price);
        let mealCategory = document.forms['edit_form']['meal_category'];
        let array = [];
        for (var i = 0; i < mealCategory.length; i++) {
            var a = mealCategory[i];
            array[i]=a.selected;
        }
        if(array.every(a=> a === false)){
            document.getElementById('error_mealCategory').style.display = "inline";
            document.getElementById("meal_category").focus();
            var scrollDiv = document.getElementById("meal_category").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_mealCategory').style.display = "none";
        }
        if(!price) {
            document.getElementById('error_price').style.display = "inline";
            document.getElementById("price").focus();
            var scrollDiv = document.getElementById("price").offsetTop;
            window.scrollTo({top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('error_price').style.display = "none";
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

