@extends('layouts.admin')

@section('body')
<h1>Dashboard</h1>

<table class="table mt-5">
  <thead class="table-dark">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
  @foreach($dailysales as $dt => $a)
    <tr>
      <td>{{$dt}}</td>
      <td>RM{{number_format($a,2)}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection