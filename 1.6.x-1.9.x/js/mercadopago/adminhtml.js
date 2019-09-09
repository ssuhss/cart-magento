window.onload = function() {

    function testModeValidation(){
        if($('payment_mercadopago_test_mode').value === '0'){
            $('mp-adminhtml-cred').style.display = "contents";
        }else{
            $('mp-adminhtml-cred').style.display = "none";
        }
    }

    testModeValidation();

    $('payment_mercadopago_test_mode').on('change',function(){
        testModeValidation();
    });

}
