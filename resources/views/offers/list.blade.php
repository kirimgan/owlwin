@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div>
          <h3>OFFERS CARTS</h3>
      </div>
        <div class="admin_offers">
            <!-- Nav tabs -->
            <ul class="nav nav-pills admin_offers__navs">
                <li @if($approved == "not_approved") class="active" @endif><a href="{{ url('/offers/list/not_approved') }}">Not Approved</a></li>
                <li @if($approved == "approved") class="active" @endif><a href="{{ url('/offers/list/approved') }}">Approved</a></li>
            </ul>

            @if($offers->count())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Employer Name</th>
                        <th>Employer Company Name</th>
                        <th>Participant Name</th>
                        <th>Added At</th>
                        @if($approved == "not_approved")
                            <th>Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($offers as $o)
                        <tr id="ad_of_{{ $o->id }}">
                            <td>{{ $o->employer->name}}</td>
                            <td>{{ $o->employer->company_info}}</td>
                            <td>{{ $o->participant->firstName}} {{ $o->participant->lastName}}</td>
                            <td>{{ $o->created_at}}</td>
                            @if($approved == "not_approved")
                                <td>
                                    <button data-offer_id="{{ $o->id }}" class="btn btn-success btn-xs js_approve_offer">approve</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $offers->links() }}
            @else
                <h4>No items were found</h4>
            @endif
        </div>

      </div>
</div>
@endsection
