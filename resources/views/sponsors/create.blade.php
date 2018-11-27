@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>CREATE SPONSOR</h1>

            {!! Form::open(['url' => url('sponsors'), 'method' => 'POST', 'files' => true]) !!}
                @include('sponsors._form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
