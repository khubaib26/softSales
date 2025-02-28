<script>
$(document).ready(function() {
    
    $('#selectMerchant').on('change', function() {
        // Selected option ko fetch karein
        const selectedOption = $(this).find(':selected');
        // data-value attribute ki value ko fetch karein
        const merchantType = selectedOption.data('value');
        // Value ko console par print karein
        console.log('Selected data-value:', merchantType);

        if(merchantType == 'Authorize'){  
            $('#authorize').show(); 
            $('#strip').hide(); 
            $('#payPal').hide();
            $('#braintree').hide();
            $('#square').hide();
            $('#2checkout').hide(); 
        } else if(merchantType == 'Strip'){  
            $('#authorize').hide(); 
            $('#strip').show(); 
            $('#payPal').hide();
            $('#braintree').hide();
            $('#square').hide();
            $('#2checkout').hide(); 
        } else if(merchantType == 'PayPal'){
            $('#authorize').hide(); 
            $('#strip').hide(); 
            $('#payPal').show();
            $('#braintree').hide();
            $('#square').hide();
            $('#2checkout').hide(); 
        } else if(merchantType == 'Braintree'){
            $('#authorize').hide(); 
            $('#strip').hide(); 
            $('#payPal').hide();
            $('#braintree').show();
            $('#square').hide();
            $('#2checkout').hide(); 
        } else if(merchantType == 'Square'){
            $('#authorize').hide(); 
            $('#strip').hide(); 
            $('#payPal').hide();
            $('#braintree').hide();
            $('#square').show();
            $('#2checkout').hide();  
        } else {
            console.log('new');
            $('#authorize').hide(); 
            $('#strip').hide(); 
            $('#payPal').hide();
            $('#braintree').hide();
            $('#square').hide();
            $('#2checkout').show(); 
        }    
    });
});
</script>