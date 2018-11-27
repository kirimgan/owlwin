@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div>
          <h3>EMPLOYER INFORMATION</h3>
      </div>
      <dl class="dl-horizontal">
          <dt>Name</dt>
          <dd>{{$user->name}}</dd>
          <dt>Email</dt>
          <dd>{{$user->email}}</dd>
          <dt>Address</dt>
          <dd>{{$user->address}}</dd>
          <dt>Location</dt>
          <dd>
              @if($user->location)
                {{$user->location->state->name}} {{$user->location->area}} {{$user->location->neighbourhood}}
              @else
                EveryWhere
              @endif
          </dd>
          <dt>Login Url</dt>
          <dd>{{ url('employer/login/' . urlencode($user->password)) }}</dd>
          <dt>Company Name</dt>
          <dd>{{ $user->company_info }}</dd>

      </dl>
      </div>
</div>
@endsection
