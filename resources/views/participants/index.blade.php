
    @extends('layouts.app')
    @section('content')  
    <?php
    $participants = $data['participants'];
    ?>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="filter_data">
    <div class="card-header">{{ __('Participants') }}</div>

<p style="padding-top: 15px">
  &nbsp;&nbsp;  <a class="btn btn-primary" href="/participant/create"><span class="glyphicon glyphicon-plus"></span> Add Participant</a>
</p>

@if(Session::has('message'))

<p class="alert
{{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}</p>

@endif
{{ Form::open(array('url' => 'list','id'=>'participants_dashboard','autocomplete'=>'off')) }}
{{ method_field('POST') }}
<table class="table table-bordered table-hover filter_data">
    <thead>
        <tr>
        <th>Name</th>
        <th>Locality</th>
        <th>DOB</th>
        <th>Age</th>
        <th>profession</th>    
        <th>No Of Guest</th>               
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr>
            <td>{!! Form::text('name',isset($_GET['name']) ? $_GET['name'] : null ,['class'=>'form-control','placeholder'=>'Name','id'=>'name','onkeyup'=>'filter_data(event)']) !!}</td>
            <td>{!! Form::text('locality',isset($_GET['locality']) ? $_GET['locality'] : null,['class'=>'form-control','placeholder'=>'Locality', 'id'=>'locality','onkeyup'=>'filter_data(event)']) !!}</td>
            <td colspan="7"></td>
        </tr>
    </thead>
    <tbody>
        @if ($participants->count() == 0)
        <tr>
            <td colspan="9">No participants to display.</td>
        </tr>
        @endif

        @foreach ($participants as $participant)
        <tr>
            <td>{{ $participant->name }}</td>
            <td>{{ $participant->locality }}</td>
            <td>{{ $participant->DOB }}</td>
            <td>{{ $participant->age }}</td>
            <td>{{ $participant->profession }}</td>
            <td>{{ $participant->number_of_guests }}</td>
            <td>
                <a class="btn btn-sm btn-success" href="{{ action('ParticipantsController@edit', ['id' => $participant->id]) }}">Edit</a>
            </td>
            <td>
                <a class="btn btn-sm btn-success" href="{{ action('ParticipantsController@show', ['id' => $participant->id]) }}">Show</a>
            </td>
            <td>
                <a class="btn btn-sm btn-danger" href="{{ action('ParticipantsController@destroy', ['id' => $participant->id]) }}">Show</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $participants->appends($data['request'])->links() }}
{{ Form::close() }}

<p>
    Displaying {{$participants->count()}} of {{ $participants->total() }} participant(s).
</p>
</div>
</div>
</div>
</div>
@endsection
@section('script')

@endsection
