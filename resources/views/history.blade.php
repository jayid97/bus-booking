@extends('layouts.app')

@section('body')
<div class="container">
<table class="table mt-2">
  <thead class="table-dark">
    <tr>
      <th scope="col">Destination</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  @foreach($bookings as $b)
    <tr>
      <td>{{$b->from}} &rarr; {{$b->to}}</td>
      <td>{{$b->date}}</td>
      <td>{{$b->time}}</td>
      <td>RM{{number_format($b->payment_amount,2)}}</td>
      <td>{{$b->payment_gateway_status}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$bookings->links()}}
@endsection
