@extends('layouts.app')

@section('calendar_script')
    <script src="{{ asset('js/calendar_script.js') }}"></script>
@endsection

@php
    use Illuminate\support\facades\Auth;
    $user_id = Auth::user()->id;
    
    $calendar = Carbon\Carbon::now();

    $firstDay = Carbon\Carbon::now()->startOfMonth();

    $lastDay = Carbon\Carbon::now()->lastOfMonth();
    $countDaysInMonth = $calendar->daysInMonth;
    $calendarMonth = $calendar->isoFormat('MMMM');

@endphp

@section('content')


@foreach ($cards as $card)
    @if ($card->updated_at->isoFormat('DD-MM-YYYY') == $selectedDate)
        <a>{{ $card->name}}{{ $card->updated_at->isoFormat('DD-MM-YYYY') }}</a>
        --------
    @else
        
    @endif
    
@endforeach

<br><br><br>

<div>
    <div class='top-calendar'>
        <a class="lastMonth"> <----- </a>
        <a>{{ $calendarMonth }}</a>
        <a class="nextMonth"> -----> </a>
    </div>
    <br>
    @for ($i = 0; $i < $countDaysInMonth; $i++)
        @if ($i == 7 OR $i == 14 OR $i == 21 OR $i == 28)
            <br>
        @endif


        <a href="{{ route('dateSelected', [$board_id , $firstDay->isoFormat('DD-MM-YYYY')]) }}" {{ $firstDay->isoFormat('DD-MM-YYYY') == $calendar->isoFormat('DD-MM-YYYY') ? "class=calendar-today"  : ''}} > {{ $firstDay->isoFormat('DD') }} </a>

        <a> - </a>


        @php
            $firstDay->add(1, 'day')       
        @endphp
    @endfor
</div>




@endsection