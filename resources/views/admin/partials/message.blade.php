<link href="{{asset(main_root())}}/toastr/toastr.min.css" rel="stylesheet"/>
<script src="{{asset(main_root())}}/toastr/jquery.min.js"></script>
<script src="{{asset(main_root())}}/toastr/toastr.js"></script>
<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('message') }}");
    @endif
        @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('status'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('status') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif

    @if(Session::has('errors'))
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
        @endif
        @endif

        toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
