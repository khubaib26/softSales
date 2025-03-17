
<script>
$(document).ready(function() {   
    
    $('.client_type').on('click', function() {
        
        var clientValue = $(this).attr('data-type');
        
        if(clientValue == 'new'){
            console.log('New client');
            
            document.getElementById('client').value= null;  
            $('#existing-client').hide();
            $('#new-client').show();

            // $('#name, #phone, #email, #projectTitle, #projectTileBlock').show();
            // $('#showClient, #showProject').hide();

            // $('#client, #projects').removeAttr('required');
            
            // $('#name, #phone, #email, #projectTitle').attr('required', true);
            // $('#name, #phone, #email, #projectTitle').val('');
        } else{
            $('#existing-client').show();
            $('#new-client').hide();
        }

    });

    $('#brand_id').on('change', function(e) {
        var BrandId = $(this).val(); 
        $('#user_id').after('<x-cxm-loader />');
        $.ajax({
            type:'GET',
            url:"{{ route('admin.get.brand.user') }}",
            data:{'BrandId': BrandId},
            success:function(cxmData){
               $('#user_id').html(cxmData);
               $('.cxm-loader').remove();
            }
      });
    });
});
</script>
