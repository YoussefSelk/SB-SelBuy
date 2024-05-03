@if ($type && $message)
    <script>
        toastr.{{ $type }}("{{ $message }}");
    </script>
@endif
