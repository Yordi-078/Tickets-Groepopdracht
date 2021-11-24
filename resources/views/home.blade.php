@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->user_role == 'admin' || Auth::user()->user_role == 'teacher' )
                    <a class="dropdown-item" href="{{ route('createBoard') }}">
                        {{ __('create board') }}
                    </a><br>
                    <a class="dropdown-item" href="{{ route('changeUserRoles') }}">
                        {{ __('change user roles') }}
                    </a><br>

                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
