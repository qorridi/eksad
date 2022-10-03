<script>
    $(document).on('click', '.delete-modal', function(){
        $('#modal_delete').modal('show');
        $('#deleted_id').val($(this).data('id'));
    });

    function deleteData(){
        $.ajax({
            type: 'POST',
            url: '{{ route($routeUrl) }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': $('#deleted_id').val()
            },
            success: function(data) {
                window.location = '{{ route($redirectUrl) }}';
            }
        });
    }
</script>
