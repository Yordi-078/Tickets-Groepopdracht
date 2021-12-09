@extends('layouts.app')
@section('content')




  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
    <a href="{{ route('home') }}">  <-Return to change user roles page </a>
  </button>

<form class="search" type="get" action="{{ route('searchAdminPage') }}">
    @csrf     
  <div class="input-group md-form form-sm form-1 pl-0">
    <div class="input-group-prepend">
      <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-danger" aria-hidden="true"></i></span>
    </div>
    <input class="form-control my-0 py-1" name="query" type="search" placeholder="Search for Name of User" aria-label="Search">
  </div>
</form>

<table class="min-w-full border-collapse block md:table">
  <thead class="block md:table-header-group">
    <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
      <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Name</th>
      <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Email</th>
      <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Role</th>
      <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Edit user role</th>
      <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Delete</th>
    </tr>
  </thead>
  <tbody class="block md:table-row-group">
    @foreach ($users as $user) 
      <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $user->name }}</td>
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $user->email }}</td>
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $user->user_role }}</td>
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><a href="{{ route('changeUserForm', [$user->id]) }}"> EDIT</a></td>
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><a href="{{ route('destroyUserPage', [$user->id]) }}">DELETE</a></td>
      </tr>
    @endforeach
  </tbody>
</table>



@endsection


