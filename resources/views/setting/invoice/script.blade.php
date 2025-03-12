
<script>
$(document).ready(function() {   
    
    $('.client_type').on('click', function() {
        
        var clientValue = $(this).attr('data-type');
        console.log(clientType);
        if(clientValue == 'new'){
            console.log('New client');
            // document.getElementById('client').value= null;  
            
            // $('#name, #phone, #email, #projectTitle, #projectTileBlock').show();
            // $('#showClient, #showProject').hide();

            // $('#client, #projects').removeAttr('required');
            
            // $('#name, #phone, #email, #projectTitle').attr('required', true);
            // $('#name, #phone, #email, #projectTitle').val('');
        } else{
            $('#projectTileBlock, #projectTitle').hide();
        }

});

});
</script>
