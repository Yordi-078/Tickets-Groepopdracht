@extends('layouts.app')
@section('content')


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script>
        $( function() {
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy'
            });        
        });
</script>

<input id="datepicker">
@endsection