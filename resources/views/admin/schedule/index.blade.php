@extends('layouts.admin')

@section('body')
@if($errors->any())
    {!! implode('', $errors->all('<div class="alert alert-danger mt-2" role="alert">:message</div>')) !!}
@endif

@if (session('status'))
    <div class="alert alert-success mt-2">
        {{ session('status') }}
    </div>
@endif

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Location
</button>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{route('admin.schedules.store')}}">
        @csrf
      <div class="modal-body">
      <div class="col-md-12">
                <div class="row">
                <select id="from" name="from" class="form-control my-2">
                    @foreach($locations as $loc)
                    <option value="{{$loc->state}}">{{$loc->state}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="row">
                <select id="from" name="to" class="form-control my-2">
                    @foreach($locations as $loc)
                    <option value="{{$loc->state}}">{{$loc->state}}</option>
                    @endforeach
                  </select>
                </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-submit">Add Schedule</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="container mt-2">
<table class="table">
  <thead class="table-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($schedules as $s)
    <tr>
      <td>{{$s->id}}</td>
      <td>{{$s->from}}</td>
      <td>{{$s->to}}</td>
      <td>
        <div class="d-flex">
        <a class="btn btn-small btn-info m-1" href="{{ route('admin.schedules.edit', $s->id) }}">Edit</a> 
      <form method="POST" action="{{route('admin.schedules.destroy', $s->id)}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-small btn-info m-1">Delete</button>
      </form>
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$schedules->links()}}
@endsection

