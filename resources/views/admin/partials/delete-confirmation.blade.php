<script>
    document.querySelector('.delete_confirm'+{{$row->id}}).addEventListener('click', function (e){
        var form = document.querySelector('.delete_confirm'+{{$row->id}}).parentElement;
        e.preventDefault()
        Swal.fire({
            title: 'Are you sure?',
            text: "If you delete this, it will be gone forever.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    })
</script>
