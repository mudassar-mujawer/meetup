@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/participant/list">Participents</a><br>
                    <a href="/accommodations/list">Accommodations</a><br>
                    <a href="/transport/list">Transport</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
