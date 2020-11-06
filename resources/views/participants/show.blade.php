


@extends('layouts.app')
    @section('content')  
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
    <div class="card-header">{{ $participants->name }}</div>

<p style="padding-top: 15px">
  &nbsp;&nbsp;  <a class="btn btn-primary" href="/participant/list"><span class="glyphicon glyphicon-plus"></span> All Participant</a>
</p>
<p style="padding: 15px">
        <strong>Name:</strong> {{ $participants->name }}<br>
        <strong>Address:</strong> {{ $participants->address }}<br>
        <strong>DOB:</strong> {{ $participants->DOB }}<br>
        <strong>Age:</strong> {{ $participants->age }}<br>
        <strong>Locality:</strong> {{ $participants->locality }}<br>
        <strong>Profession:</strong> {{ $participants->profession }}<br>
        <strong>No Of Guest:</strong> {{ $participants->number_of_guests }}<br>
    </p>

</div></div>
</div>
@endsection