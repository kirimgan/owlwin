@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>EDIT EMPLOYER</h1>
            <hr>
            {!! Form::open(['url' => '/employer/edit-employer/update/'. $entry->id, 'method' => 'POST', 'files' => true]) !!}
            @include('layouts.form-errors')
            <div class="row">
                <div class="col-sm-6">
                    <h4>PERSONAL INFORMATION</h4>
                    <div class="form-group">
                        <label class="required" for="name">Name</label>
                        {!! Form::text('name', $entry->name,
                                                    ['id' => "Name",
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Full name']) !!}
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        {!! Form::text('email', $entry->email,
                                                    ['id' => "email",
                                                    'class' => 'form-control',
                                                    'placeholder' => 'E-mail']) !!}
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        {!! Form::text('address', $entry->address,
                                                    ['id' => "address",
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Address']) !!}
                    </div>
                    <div class="form-group">
                        <label class="required" for="state">Location</label>
                        {!! Form::select('location_id',
                        ["" => "Everywhere"] + $locations,
                        $entry->location_id,
                        ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label for="company_info">Company Name</label>
                        {!! Form::text('company_info', $entry->company_info, ['id' => "company_info", 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4>STUDENTS</h4>
                    <p>
                        <button type="button" class="btn btn-sm btn-primary js_select_all">Select All</button>
                        <button type="button" class="btn btn-sm btn-default js_unselect_all">Unselect All</button>
                    </p>
                    <?php $activeItems = $entry->students->pluck('id')->toArray(); ?>
                    @foreach($students as $student)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('students[]',
                                    $student->id,
                                    in_array($student->id, $activeItems)) !!}
                                {!! $student->fullName !!}
                            </label>
                        </div>
                    @endforeach
                    <div>* All students are shown by default</div>
                </div>
            </div>

            <hr>
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
