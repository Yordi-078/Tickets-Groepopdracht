@extends('layouts.app')

@section('calendar_script')
    <script src="{{ asset('js/calendar_script.js') }}"></script>
@endsection

@php
    use Illuminate\support\facades\Auth;
    $user_id = Auth::user()->id;
    $array = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
    $dateFormat = false;
    $calendar = Carbon\Carbon::now();
    $firstDay = Carbon\Carbon::now()->startOfMonth();
    $lastDay = Carbon\Carbon::now()->lastOfMonth();
    $countDaysInMonth = $calendar->daysInMonth;
    $calendarMonth = $calendar->isoFormat('MMMM-YYYY');
@endphp

@section('content')


<div class="calendar">
    <div class="calendar-top-row">
        <button btn id="previousMonth"> <----- </button>
        <a>{{ $calendarMonth }}</a>
        <button btn id="nextMonth"> -----> </button>
    </div>
    
    <div class="calendar-date">
        @for ($i = 0; $i < 7; $i++)
            <div class="calendar-day">
                <a>{{ $array[$i] }}</a>
            </div>
        @endfor
        @for ($i = 0; $i < $countDaysInMonth; $i++)
            @if($dateFormat == false)
                @if($firstDay->isoFormat('dd') == $array[$i])
                    @php
                        $dateFormat = true
                    @endphp
                @else
                    <div class="calendar-number"></div>
                @endif
            @endif

            <div class="calendar-number">
                <a href="{{ route('dateSelected', [$board_id , $firstDay->isoFormat('DD-MM-YYYY')]) }}" {{ $firstDay->isoFormat('DD-MM-YYYY') == $calendar->isoFormat('DD-MM-YYYY') ? "class=calendar-today"  : ''}} > {{ $firstDay->isoFormat('DD') }} </a>
            </div>

            @if ($dateFormat !== false)
                @php
                    $firstDay->add(1, 'day')       
                @endphp
            @endif
        @endfor
    </div>
</div>



@endsection