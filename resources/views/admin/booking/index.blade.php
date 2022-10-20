@extends('layouts.admin')

@section('body')

@if (session('status'))
    <div class="alert alert-success mt-2">
        {{ session('status') }}
    </div>
@endif
<div class="container">
<table class="table mt-2">
  <thead class="table-dark">
    <tr>
      <th scope="col">Order Number</th>
      <th scope="col">Destination</th>
      <th scope="col">Name</th>
      <th scope="col">Create Date</th>
      <th scope="col">Payment Amount</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Status</th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
  @foreach($book as $b)
    <tr>
      <td>#{{$b->id}}</td>
      <td>{{$b->service->schedule->from}} &rarr; {{$b->service->schedule->to}}</td>
      <td>{{$b->user->name}}</td>
      <td>{{$b->created_at}}</td>
      <td>RM{{number_format($b->payment_amount,2)}}</td>
      <td>{{$b->payment_gateway_status}}</td>
      <td>{{$b->status}}</td>
      <td> 
        @if($b->status != "Cancelled")
      <form method="POST" action="{{ route('admin.bookings.update',['booking'=> $b]) }}">
        @csrf
        @method('PUT')
      <button class="btn btn-primary" onclick="return confirm('Are you sure want to cancel?')">Cancel Booking</button>
      @endif
      </form>  
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$book->links()}}
@endsection
