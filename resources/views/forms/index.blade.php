@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>JOB APPLICATION FORM/ STUDENT CV ENTRIES</h1>
            <a class="btn btn-default" href="/forms/create">Add new</a>
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-2">First Name</th>
                        <th class="col-sm-2">Last Name</th>
                        <th class="col-sm-3">Location to go</th>
                        <th class="col-sm-4">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($entries as $entry)
                        <tr class="@if(!$entry->is_available) warning @endif">
                            <td>{{$entry->id}}</td>
                            <td>{{$entry->firstName}}</td>
                            <td>{{$entry->lastName}}</td>
                            <td>
                            @if(isset($entry->location))
                               {{ $entry->location->state->name}} -> {{ ($entry->location->area) ?  $entry->location->area : "EveryWhere"}}
                            @else
                                EveryWhere
                            @endif
                            @if(isset($entry->location->neighbourhood) && $entry->location->neighbourhood !== '')
                               -> {{ $entry->location->neighbourhood}}
                            @endif
                            </td>
                            <td>
                                <div style="margin-right: 5px;" class="pull-left">
                                    <a class="btn btn-primary btn-xs" href="/forms/edit/{{$entry->id}}">Edit</a>
                                </div>

                                <div style="margin-right: 5px;" class="pull-left">
                                    {{Form::open(array('method'=>'delete', 'onsubmit' => 'return confirm("Are you sure?")',
                                          'url' => route('forms.destroy', $entry->id)))}}
                                        <button type="submit" name="submit" class="btn btn-danger btn-xs">Delete</button>
                                    {{Form::close()}}
                                </div>
                                <div style="margin-right: 5px;" class="pull-left">
                                    <a class="btn btn-xs btn-success js-view-pdf"
                                       target="_blank" href="{{ url('/forms/view-pdf/' . $entry->id) }}">View Resume</a>
                                </div>

                                @if($entry->offer_id and $entry->signed_form)
                                    <div class="pull-left">
                                        <a class="btn btn-xs btn-success js-view-pdf"
                                           target="_blank" href="{{ url('/offers/signed/' . $entry->offer_id)  }}">View Signed Form</a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <p>
                    <span class="alert alert-warning">* Students with status - Not available</span>
                </p>
            </div>
            <div class="row">
                {!! $entries->render() !!}
            </div>
        </div>
    </div>

    @include('blocks.modal_pdf')
@endsection
