@extends('layouts.app')

@section('calendar_script')
    <script src="{{ asset('js/calendar_script.js') }}"></script>
@endsection

<style>

    .calendar {
        position: relative;
        width: 300px;
        background-color: #fff;
        box-sizing: border-box;
        box-shadow: 0 5px 50px rgba(#000, 0.5);
        border-radius: 8px;
    }

    .calendar__date {
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(25px, 1fr));
        grid-gap: 10px;
        box-sizing: border-box;
    }

    .calendar__day {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 25px;
        font-weight: 600;
        color: #262626;
        
        &:nth-child(7) {
            color: #ff685d;
        }
    }

    .calendar__number {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 25px;
        color: #262626;

        &:nth-child(7n) {
            color: #ff685d;
            font-weight: 700;
        }
    
        &--current,
        &:hover {
            background-color: #009688;
            color: #fff !important;
            font-weight: 700;
            cursor: pointer;
        }
    }
</style>

@php
    use Illuminate\support\facades\Auth;
    $user_id = Auth::user()->id;
    $array = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
    
    $calendar = Carbon\Carbon::now();

    $firstDay = Carbon\Carbon::now()->startOfMonth();

    $lastDay = Carbon\Carbon::now()->lastOfMonth();
    $countDaysInMonth = $calendar->daysInMonth;
    $calendarMonth = $calendar->isoFormat('MMMM');

@endphp

@section('content')


@foreach ($cards as $card)
        <a>
            {{ $card->updated_at->isoFormat('DD-MM-YYYY') }}
        </a>
        <br>
@endforeach

@foreach ($lessonCards as $lessonCard)
    <a>
        {{ $lessonCard->name }}
    </a>
@endforeach

<br>




<div class="calendar">
    <button id="previousMonth"> <----- </button>
        <a>{{ $calendarMonth }}</a>
    <button btn id="nextMonth"> -----> </button>
    
    <div class="calendar__date">
        @for ($i = 0; $i < 7; $i++)
            <div class="calendar__day">
                <a>{{ $array[$i] }}</a>
            </div>
        @endfor
        @for ($i = 0; $i < $countDaysInMonth; $i++)
            <div class="calendar__number">
                <a href="{{ route('dateSelected', [$board_id , $firstDay->isoFormat('DD-MM-YYYY')]) }}" {{ $firstDay->isoFormat('DD-MM-YYYY') == $calendar->isoFormat('DD-MM-YYYY') ? "class=calendar-today"  : ''}} > {{ $firstDay->isoFormat('DD') }} </a>
            </div>
            @php
                $firstDay->add(1, 'day')       
            @endphp
        @endfor


    </div>
  </div>



@endsection