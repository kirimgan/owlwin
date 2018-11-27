@include('layouts.form-errors')
<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name', $sponsor->name,
        ['id' => "name", 'class' => 'form-control', 'placeholder' => 'Sponsor name']) !!}
</div>
<div class="form-group">
    <label for="offer_form">Offer Form (pdf format)</label>
    {!! Form::file('offer_form', null,
        ['id' => "offer_form",
        'class' => 'form-control',
        'placeholder' => 'E-mail']) !!}
</div>
@if($sponsor->offer_form)
    <p>Uploaded Pdf: <a class="js-view-pdf" href="{{ url('/sponsors/view-pdf/' . $sponsor->id) }}">{{ $sponsor->offer_form }}</a></p>
    @include('blocks.modal_pdf')
@endif

<button type="submit" class="btn btn-default">Save</button>