{{--form validation--}}
<script>
    function validateForm(event){
        // event.preventDefault();
        let flag = true;
        let maximum_range = document.forms['create_form']['maximum_range'].value;
        let price_kilometer = document.forms['create_form']['price_kilometer'].value;
        let start_calculating = document.forms['create_form']['start_calculating'].value;

        if(start_calculating == ""){
            document.getElementById('start_calculating_error').style.display = "inline";
            document.getElementById("start_calculating").focus();
            var scrollDiv = document.getElementById("start_calculating").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('start_calculating_error').style.display = "none";
        }
        if(price_kilometer == ""){
            document.getElementById('Price_kilometer_error').style.display = "inline";
            document.getElementById("price_kilometer").focus();
            var scrollDiv = document.getElementById("price_kilometer").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('Price_kilometer_error').style.display = "none";
        }
        if(maximum_range == ""){
            document.getElementById('maximum_range_price_error').style.display = "inline";
            document.getElementById("maximum_range").focus();
            var scrollDiv = document.getElementById("maximum_range").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
            flag = false;
        }else {
            document.getElementById('maximum_range_price_error').style.display = "none";
        }
        return flag;
    }
</script>

