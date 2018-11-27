@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div>
          <h3>EMPLOYER LIST</h3>
      </div>
      <div>
      <a class="btn btn-default" href="/employer/create">Add new</a>
      </div>
      </br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Company Name</th>
                <th>Address</th>
                <th>Location</th>
                <th>Login Url</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($users as $u)
            <tr>
                <td>{{ $u->name}}</td>
                <td>{{ $u->company_info}}</td>
                <td>{{ $u->address}}</td>
                <td>
                @if(isset($u->location))
                   {{ $u->location->state->name}} -> {{ ($u->location->area) ? $u->location->area : " All" }}
                @else
                    EveryWhere
                @endif
                @if(isset($u->location->neighbourhood) && $u->location->neighbourhood !== '')
                   -> {{ $u->location->neighbourhood}}
                @endif
                </td>
                <td>
                    <span id="empl_link_{{ $u->id  }}">{{ url('employer/login/' . urlencode($u->password)) }}</span>
                    <button data-clipboard-target="#empl_link_{{ $u->id  }}" class="js_copy_link btn btn-xs btn-info pull-right">copy</button>
                </td>
                <td>
                  <div class="pull-left" style="margin-right: 5px;">
                    <form action="edit-employer/{{$u->id}}">
                      <button type="submit" id="btn-form" class="btn btn-primary btn-xs">Edit</button>
                    </form>
                  </div>
                  <div class="pull-left">
                    {{Form::open(array('method'=>'delete', 
                      'onsubmit' => 'return confirm("Are you sure?")', 
                      'url' => route('employer.destroy', $u->id)))}}
                        <button type="submit" name="submit" class="btn btn-danger btn-xs">Delete</button>
                    {{Form::close()}}
                  </div>  
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
      {{ $users->links() }}
      </div>
</div>
@endsection
