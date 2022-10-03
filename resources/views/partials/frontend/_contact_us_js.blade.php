<script>
    $('#success_feedback').hide();
    $('#error_feedback').hide();

    function submitContactUs() {
        var contactName = $('#contact_name').val();
        var contactPhone = $('#contact_phone').val();
        var contactEmail = $('#contact_email').val();
        var contactManager = $('#contact_manager').val();
        var contactCompany = $('#contact_company').val();
        var contactMessage = $('#contact_message').val();

        if(!contactName ||
            contactName === '' ||
            !contactEmail ||
            contactEmail === '' ||
            !contactPhone ||
            contactPhone === '' ||
            !contactManager ||
            contactManager === '' ||
            !contactCompany ||
            contactCompany === '' ||
            !contactMessage ||
            contactMessage === ''
        ){
            return false;
        }

        $.ajax({
            type:'POST',
            url:'{{ route('frontend.contact_us.save.ajax') }}',
            data:{
                '_token': '{{ csrf_token() }}',
                'contact_name': contactName,
                'contact_phone': contactPhone,
                'contact_email': contactEmail,
                'contact_manager': contactManager,
                'contact_company': contactCompany,
                // 'contact_budget': contactEmail,
                'contact_message': contactMessage
            },
            success:function(data){
                let error = data['error'];
                if(error === 'none'){
                    $('#success_feedback').show('slide', {direction: "bottom" }, 500);
                }
                else{
                    $('#error_feedback').show('slide', {direction: "bottom" }, 500);
                }
            }
        });
    }
</script>
