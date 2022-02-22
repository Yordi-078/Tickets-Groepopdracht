@extends('layouts.app')
@section('content')




  <button class="change-user-back-button">
    <a href="{{ route('home') }}">  <-Return to change user roles page </a>
  </button>

<table class="table-change-user-role"> 
<thead class="table-header">
  <tr class="">
    <th class="">
      <form class="search" type="get" action="{{ route('searchAdminPage') }}">
        @csrf     
        <div class="table-search-bar">
            <span class="" id="basic-text1"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input class="" name="query" type="search" placeholder="Search for Name of User" aria-label="Search">
        </div>
      </form>
    </th>
    <th class="">Email</th>
    <th class="">Role</th>
    <th class="">Edit user role</th>
    <th class="">Delete</th>
  </tr>
</thead>
<tbody class="table-body">
    @foreach ($users as $user) 
      <tr class="">
        <td class="">{{ $user->name }}</td>
        <td class="">{{ $user->email }}</td>
        <td class="">{{ $user->user_role_id}}</td>
        <td class=""><a href="{{ route('changeUserForm', [$user->id]) }}"> EDIT</a></td>
        <td class=""><a href="{{ route('destroyUserPage', [$user->id]) }}">DELETE</a></td>
      </tr>
    @endforeach
  </tbody>
</table> 


@endsection


