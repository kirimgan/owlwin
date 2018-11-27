@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row"> 
    <div>
        <h3>CREATE LOCATION</h3>
    </div>
      {!! Form::open(['url' => '/locations/store', 'method' => 'POST']) !!}
          <div class="form-group">
            <label for="state">State</label>
              {!! Form::select('state_id',
              [null => 'Please select state'] + $states->toArray(), 
              null,
              ['class' => 'form-control',
              'placeholder' => 'State']) !!}
          </div>
          <div class="form-group">
            <label for="name">Area</label>
            {!! Form::text('area', null, 
            ['id' => "area", 
            'class' => 'form-control',
            'placeholder' => 'Area name']) !!}
          </div>
          <div class="form-group">
            <label for="email">Neighbourhood</label>
            {!! Form::text('neighbourhood', null, 
                                        ['id' => "email", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Neighbourhood name']) !!}
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
          {!! Form::close() !!}
    </div>
</div>
@endsection
