<script src="{{asset('public/assets')}}/toast.js"></script>
<script>
    @if(session()->has('success'))
    message('{{session()->get('success')}}')
    @endif

    @if(session()->has('error'))
    message('{{session()->get('error')}}')
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            message('{{ $error }}')
        @endforeach
    @endif
</script>



{{--<script src="{{asset('public/common')}}/sweetalert2.js"></script>--}}
{{--<script>--}}
{{--    var Toast = Swal.mixin({--}}
{{--        toast: true,--}}
{{--        position: 'top-end',--}}
{{--        showConfirmButton: false,--}}
{{--        timer: 3000--}}
{{--    });--}}
{{--    @if ($errors->any())--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--        Toast.fire({--}}
{{--            icon: 'error',--}}
{{--            title: '{{$error}}'--}}
{{--        })--}}
{{--        @endforeach--}}
{{--    @endif--}}

{{--    @if(session()->has('success'))--}}
{{--        Toast.fire({--}}
{{--            icon: 'success',--}}
{{--            title: '{{session()->get('success')}}'--}}
{{--        })--}}
{{--    @endif--}}

{{--    @if(session()->has('error'))--}}
{{--        Toast.fire({--}}
{{--            icon: 'error',--}}
{{--            title: '{{session()->get('error')}}'--}}
{{--        })--}}
{{--    @endif--}}
{{--</script>--}}
