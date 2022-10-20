@extends('layouts.admin')

@section('body')
<h1>Users</h1>
<form action="{{route('admin.users.index')}}" class="d-flex my-4">
<input type="text" name="search" placeholder="search name/email" class="flex-grow-1 form-control" value="{{request()->search}}">
<button class="btn btn-primary">Search</button>
<a class="btn" href="{{route('admin.users.index')}}">Reset</a>
</form>
<table class="table mt-5">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created at</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $u)
    <tr>
      
      <td>{{$u->id}}</td>
      <td>{{$u->name}}</td>
      <td>{{$u->email}}</td>
      <td>{{$u->created_at}}</td>
      <td> 
        <a class="btn btn-small btn-info" href="{{ route('admin.users.destroy', $u->id) }}">Delete</a>
      </td>
    @endforeach
  </tbody>
</table>

{{$users->appends(request()->except('page'))->links()}}

@endsection