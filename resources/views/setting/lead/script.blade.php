

<script>
$(document).ready(function() { 

    $('.assingUser').on('change', function(e) {
        e.preventDefault(); 

        var userId = this.value;
        var leadId = $(this).attr('data-cxm-lead-id');
        var selectDropdown = $(this);
        // console.log(userId);
        // console.log(leadId);
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to assign this user to the lead!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, assign!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.leadAssingUser') }}",
                    data: { 'user_id': userId, 'lead_id': leadId },
                    success: function(data) { 
                        console.log(data);
                        Swal.fire(
                            'Assigned!',
                            'The user has been assigned to the lead successfully.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'There was an issue assigning the user to the lead.',
                            'error'
                        );
                        selectDropdown.val(selectDropdown.data('previous-value'));
                    }
                });
            } else {
                selectDropdown.val(selectDropdown.data('previous-value'));
            }
        });
    });

    $('.assingUser').each(function() {
        $(this).data('previous-value', $(this).val());
    });


    $('.changeStatus').on('change', function(e) {
        e.preventDefault();

        var statusId = this.value;
        var leadId = $(this).attr('data-cxm-lead-id');
        var selectDropdown = $(this);

        console.log(statusId);
        console.log(leadId);

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to change lead status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, assign!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if(leadId != ''){
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "{{ route('admin.changeLeadStatus') }}",
                        data: {'lead_id': leadId, 'LeadStatus': statusId},
                        success: function(data){
                            console.log(data);
                        },
                        error: function(data){
                            console.log(data); 
                        }
                    });
                }else{
                    //swal("Error!", "Select Brand", "error");
                }
            } else {
                selectDropdown.val(selectDropdown.data('previous-value'));
            }
        });   
    });    
});
</script>
