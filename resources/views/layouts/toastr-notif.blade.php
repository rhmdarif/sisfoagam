
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

<script>
    function alertDanger(msg=null) {
        $.toast({
            heading: 'Failed',
            text: msg,
            showHideTransition: 'slide',
            icon: 'error',
            position: 'top-right'
        });
    }

    function alertSuccess(msg=null) {
        $.toast({
            heading: 'Success',
            text: msg,
            showHideTransition: 'slide',
            icon: 'success',
            position: 'top-right'
        });
    }
</script>
