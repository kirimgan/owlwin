@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div>
          <h3>LOCATIONS LIST</h3>
      </div>
      <div>
      <a class="btn btn-default" href="/locations/create">Add new</a>
      </div>
      </br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>State</th>
                <th>Area</th>
                <th>Neighbourhood</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($locations as $l)
            <tr>
                <td>{{ $l->state->name}}</td>
                <td>{{ $l->area}}</td>
                <td>{{ $l->neighbourhood}}</td>
                <td>
                    <div class="pull-left" style="margin-right: 5px;">
                      <form action="edit-location/{{$l->id}}">
                        <button type="submit" class="btn btn-primary btn-xs">Edit</button>
                      </form>
                    </div>

                    <div class="pull-left">
                        {{Form::open(array('method'=>'delete', 'onsubmit' => 'return confirm("Are you sure?")', 'url' => route('location.destroy', $l->id)))}}
                        <button type="submit" name="submit" class="btn btn-danger btn-xs">Delete</button>
                        {{Form::close()}}
                    </div>
                
                
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
      {{ $locations->links() }}
      </div>
</div>
@endsection
