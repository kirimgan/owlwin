@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div>
                <h3>Sponsors LIST</h3>
            </div>
            <div>
                <a class="btn btn-default" href="{{ route('sponsors.create') }}">Add new</a>
            </div>
            </br>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-sm-7">Name</th>
                    <th class="col-sm-3">Offer Form</th>
                    <th class="col-sm-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sponsors as $sponsor)
                    <tr>
                        <td>{{ $sponsor->name}}</td>
                        <td>
                            @if($sponsor->offer_form)
                                <a class="js-view-pdf" href="{{ url('/sponsors/view-pdf/' . $sponsor->id) }}">{{ $sponsor->offer_form }}</a>
                            @else
                                not uploaded
                            @endif
                        </td>
                        <td>
                            <div class="pull-left" style="margin-right: 5px;">
                                <form action="{{ route('sponsors.edit', $sponsor->id)  }}">
                                    <button type="submit" id="btn-form" class="btn btn-primary btn-xs">Edit</button>
                                </form>
                            </div>
                            <div class="pull-left">
                                {{Form::open(array('method'=>'delete',
                                  'onsubmit' => 'return confirm("Are you sure?")',
                                  'url' => route('sponsors.destroy', $sponsor->id)))}}
                                <button type="submit" name="submit" class="btn btn-danger btn-xs">Delete</button>
                                {{Form::close()}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $sponsors->links() }}
        </div>
    </div>
    @include('blocks.modal_pdf')
@endsection
