@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"> 
    <div>
        <h3>EDIT LOCATION</h3>
    </div>
      {!! Form::open(['url' => '/locations/edit-location/update/' . $entry->id, 'method' => 'POST', 'files' => true]) !!}
          <div class="form-group">
            <label for="state">State</label>
              {!! Form::select('state_id',
              $states->toArray(), 
              $entry->state_id,
              ['class' => 'form-control',
              'placeholder' => 'State']) !!}
          </div>
          <div class="form-group">
            <label for="area">Area</label>
            {!! Form::text('area', $entry->area, 
            ['id' => "area", 
            'class' => 'form-control',
            'placeholder' => 'Area name']) !!}
          </div>
          <div class="form-group">
            <label for="neighbourhood">Neighbourhood</label>
            {!! Form::text('neighbourhood', $entry->neighbourhood, 
                                        ['id' => "neighbourhood", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Neighbourhood name']) !!}
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
          {!! Form::close() !!}
    </div>
</div>
@endsection