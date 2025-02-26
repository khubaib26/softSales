
<script>
$(document).ready(function() {   
   
    $("#UserTable").on("change", ".toggle-class", function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
        var toggleSwitch = $(this); 
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to change the user's status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.userStatus') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        Swal.fire(
                            'Updated!',
                            'The user status has been updated.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an issue updating the status.',
                            'error'
                        );
                        toggleSwitch.prop('checked', !status);
                    }
                });
            } else {
                toggleSwitch.prop('checked', !status);
            }
        });
    });

    //open user credit model
    $("#UserTable").on("click", ".userCredit", function(){    
        console.log('user Credits');
        var user_id = $(this).data('id');
        document.getElementById("user_hdn").value = user_id;
        console.log(user_id);
    });

    //Open Brand Assing Model
    $("#UserTable").on("click", ".assignBrand", function(){    
        console.log('assign Brand');
        var user_id = $(this).data('id');
        document.getElementById("user_hdn2").value = user_id;
        console.log(user_id);
    });

    // create User Credits
    $('#UserCreditForm').on('submit', function(e){
       e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax({
                url: "{{ route('admin.UsersCredit') }}",
                method:'POST',
                data: $(this).serialize(), // get all form field value in serialize form
                success: function(data){
                    $("#UserCreditForm")[0].reset();
                    console.log(data);
                    $("#creditModal").modal('hide');

                    // setTimeout(function(){
                    //         window.location='{{url("/admin/users")}}';
                    // }, 2000);    
                },
                error: function(){
                    // $('.page-loader-wrapper').css('display', 'none');
                    // swal("Errors!", "Request Fail!", "error");     
                }
        });
    });

    // create User Credits
    $('#BrandAssingForm').on('submit', function(e){
       e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        console.log("form submit");

        $.ajax({
                url: "{{ route('admin.AssingBrandUser') }}",
                method:'POST',
                data: $(this).serialize(), // get all form field value in serialize form
                success: function(data){
                    $("#BrandAssingForm")[0].reset();
                    console.log(data);
                    $("#brandModal").modal('hide');

                    // setTimeout(function(){
                    //         window.location='{{url("/admin/users")}}';
                    // }, 2000);    
                },
                error: function(){
                    // $('.page-loader-wrapper').css('display', 'none');
                    // swal("Errors!", "Request Fail!", "error");     
                }
        });
    });

});
</script>
