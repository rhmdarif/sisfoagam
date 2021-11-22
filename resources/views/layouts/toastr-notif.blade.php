
@if (session("success"))
    <script>
        $.toast({
            heading: 'Success',
            text: "{{ session('success') }}",
            showHideTransition: 'slide',
            icon: 'success',
            position: 'top-right'
        });
    </script>
@endif


@if (session("error"))
    <script>
        $.toast({
            heading: 'Failed',
            text: "{{ session('error') }}",
            showHideTransition: 'slide',
            icon: 'error',
            position: 'top-right'
        });
    </script>
@endif
