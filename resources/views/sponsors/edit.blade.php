@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>Edit SPONSOR</h1>

            {!! Form::open(['url' => route('sponsors.update', $sponsor->id),
                'method' => 'PATCH',
                'files' => true]) !!}

                @include('sponsors._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection
