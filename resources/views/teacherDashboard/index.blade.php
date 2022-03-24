@extends('layouts.app')

@php
    use Illuminate\support\facades\Auth;
    $user_id = Auth::user()->id;
    
    $calendar = Carbon\Carbon::now();

    $firstDay = Carbon\Carbon::now()->startOfMonth();
    $firstDay = $firstDay->sub(1, 'day');

    $lastDay = Carbon\Carbon::now()->lastOfMonth();
    $countDaysInMonth = $calendar->daysInMonth;
    $calendarMonth = $calendar->isoFormat('MMMM');

@endphp

@section('content')


@foreach ($cards as $card)
        <a>
            {{ $card->updated_at->isoFormat('DD-MM-YYYY') }}
        </a>
    
@endforeach


<div>
    <a>{{ $calendarMonth }}</a>
    <br>
    @for ($i = 0; $i < $countDaysInMonth; $i++)
        @php
            $firstDay->add(1, 'day')       
        @endphp
    


        <a href="{{ route('dateSelected', [$board_id , $firstDay->isoFormat('DD-MM-YYYY')]) }}"> {{ $firstDay->isoFormat('DD') }} </a>
        <br>
    @endfor
</div>




@endsection