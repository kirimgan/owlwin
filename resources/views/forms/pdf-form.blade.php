@extends('layouts.forms')
@section('content')
<div id="application-cv">
    <h1 style="margin-left: 30%">JOB APPLICATION FORM/STUDENT CV</h1>
    <div class="block-title">PERSONAL INFORMATION</div>
    <br>
    <div class="half-page">
        <p><b>First Name:</b> {{ $firstName }}</p>
        <p><b>Last Name:</b> {{ $lastName }}</p>
        <p><b>Country:</b> {{ $country }}</p>
        <p><b>Address:</b> {{ $address }}</p>
        <p><b>Native language:</b> {{ $language }}</p>
        <p><b>English level:</b> {{ $englishLevel }}</p>
        <p><b>Gender:</b> {{ $gender }}</p>
        <p><b>Date of birth:</b> {{ prepareDateForView($dateOfBirth) }}</p>
        <p><b>Email:</b> {{ $email }}</p>
        <p><b>Skype:</b> {{ $skype }}</p>
    </div>
    <div class="half-page">
        <img class="photo" src="{{ $photoUrl}}">
    </div>
    <div style="clear:both;"></div>
    <br>
    <div class="quarter-page">
        <p><b>Phone Home Number (country-city-number):</b>
    </div>
    <div class="quarter-page">
        <p>{{ $phoneHome }}</p>
    </div>
    <div class="quarter-page">
        <p><b>Mobile Home Number (country-city-number):</b>
    </div>
    <div class="quarter-page">
        <p>{{ $phoneMobile }}</p>
    </div>
    <div style="clear:both;"></div>
    <div class="quarter-page">
        <b>Height (cm):</b>
    </div>
    <div class="quarter-page">
        <p>{{ $height }}</p>
    </div>
    <div class="quarter-page">
        <p><b>Size of t-shirt:</b></p>
    </div>
    <div class="quarter-page">
          <p>{{ $size }}</p>
    </div>
    <div style="clear:both;"></div>

    <div class="block-title">EDUCATION, WORK EXPERIENCE, SKILLS</div>
    <br>
    <div class="half-page">
        <p><b>Educational Institution:</b></p>
    </div>
    <div class="half-page">
          <p>{{ $education }}</p>
    </div>
    <div style="clear:both;"></div>

    <div class="half-page">
        <p><b>Field of study:</b></p>
    </div>
    <div class="half-page">
          <p>{{ $study }}</p>
    </div>
    <div style="clear:both;"></div>

    <div class="half-page">
        <p><b>Earliest J1 job start date:</b></p>
    </div>
    <div class="half-page">
          <p>{{ prepareDateForView($earliestDate) }}</p>
    </div>
    <div style="clear:both;"></div>

    <div class="half-page">
        <p><b>Latest J1 job end date:</b></p>
    </div>
    <div class="half-page">
          <p>{{ prepareDateForView($latestDate) }}</p>
    </div>
    <div style="clear:both;"></div>

    <div class="half-page">
        <p><b>Driving experience:</b></p>
    </div>
    <div class="half-page">
          <p>{{ $drivingExperience }}</p>
    </div>
    <div style="clear:both;"></div>


    <div class="half-page">
        <p><b>What other languages do you know?:</b></p>
    </div>
    <div class="half-page">
          <p>{{ $otherLanguage }}</p>
    </div>
    <div style="clear:both;"></div>

    <div class="half-page">
        <p><b>Have you been to the United States before?:</b></p>
    </div>
    <div class="half-page">
          <p>{{ $beforeUS }}</p>
    </div>
    <div style="clear:both;"></div>

    <div class="half-page">
        <p><b>Work experience:</b></p>
    </div>
    <div class="half-page">
          <p>{!! nl2br($workExperience) !!}</p>
    </div>
    <div style="clear:both;"></div>
    <div class="half-page">
        <p><b>Your hobbies, interests, skills, certificates:</b></p>
    </div>
    <div class="half-page">
          <p>{!! nl2br($skills) !!}</p>
    </div>
    <div style="clear:both;"></div>
</div>
@endsection