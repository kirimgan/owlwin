@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>CREATE EMPLOYER</h1>

            <div>
                <h3>PERSONAL INFORMATION</h3>
            </div>
            {!! Form::open(['url' => '/employer/store', 'method' => 'POST']) !!}
            @include('layouts.form-errors')

            <div class="form-group">
                <label class="required" for="name">Name</label>
                {!! Form::text('name', null,
                                            ['id' => "Name",
                                            'class' => 'form-control',
                                            'placeholder' => 'Full name']) !!}
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                {!! Form::text('email', null,
                                            ['id' => "email",
                                            'class' => 'form-control',
                                            'placeholder' => 'E-mail']) !!}
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                {!! Form::text('address', null,
                                            ['id' => "address",
                                            'class' => 'form-control',
                                            'placeholder' => 'Address']) !!}
            </div>
            <div class="form-group">
                <label class="required" for="state">Location</label>
                {!! Form::select('location_id',
                ["" => "Everywhere"] + $locations,
                null,
                ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="company_info">Company Name</label>
                {!! Form::text('company_info', null, ['id' => "company_info", 'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
