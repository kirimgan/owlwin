@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <h1>JOB APPLICATION FORM/ STUDENT CV</h1>
    @include('layouts/form-errors')
    <div>
        <h3>PERSONAL INFORMATION</h3>
    </div>
      {!! Form::open(['url' => '/forms/makepdf', 'method' => 'POST', 'files' => true]) !!}

          <div class="form-group">
            <label for="firstName">First Name</label>
            {!! Form::text('firstName', null, 
                                        ['id' => "firstName", 
                                        'class' => 'form-control',
                                        'placeholder' => 'First Name']) !!}
          </div>
          <div class="form-group">
            <label for="lastName">Last Name</label>
            {!! Form::text('lastName', null, 
                                        ['id' => "lastName", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Last Name']) !!}
          </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            {!! Form::file('photo') !!}
          </div>
          <div class="form-group">
            <label for="country">Country</label>
            {!! Form::text('country', null, 
                                        ['id' => "country", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Country']) !!}
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            {!! Form::text('address', null, 
                                        ['id' => "address", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Address']) !!}
          </div>
          <div class="form-group">
            <label for="language">Native Language</label>
            {!! Form::text('language', null, 
                                        ['id' => "language", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Language']) !!}
          </div>
          <div class="form-group">
              <label for="size">English level</br>(Beginner, Intermediate, Advanced)</label>
            {!! Form::select('englishLevel', array('Beginner' => 'Beginner', 'Intermediate' => 'Intermediate', 'Advanced' => 'Advanced'), null, 
                                        ['id' => "englishLevel", 
                                        'class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              <label for="gender">Gender</label>
            {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), null, 
                                        ['id' => "gender", 
                                        'class' => 'form-control']) !!}
          </div>
        <div class="form-group">
            <label for="dateOfBirth">Date of Birth </label></br>(Month, Day, Year)</label>
            <div class="input-group date" data-provide="datepicker">
                {!! Form::text('dateOfBirth', null,
                    ['id' => "dateOfBirth", 'class' => 'form-control datepicker',
                    'placeholder' => 'Month/Day/Year']) !!}
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>

          <div class="form-group">
            <label for="email">E-mail</label>
            {!! Form::text('email', null, 
                                        ['id' => "email", 
                                        'class' => 'form-control',
                                        'placeholder' => 'E-mail']) !!}
          </div>
          <div class="form-group">
            <label for="skype">Skype</label>
            {!! Form::text('skype', null, 
                                        ['id' => "skype",
                                        'class' => 'form-control',
                                        'placeholder' => 'Skype id']) !!}
          </div>
          <div class="form-group">
            <label for="phoneHome">Phone Home Number </br>(country-city-number)</label>
            {!! Form::text('phoneHome', null, 
                                        ['id' => "phoneHome", 
                                        'class' => 'form-control',
                                        'placeholder' => '1-222-33333333']) !!}
          </div>
          <div class="form-group">
            <label for="phoneMobile">Phone Mobile Number </br>(country-city-number)</label>
            {!! Form::text('phoneMobile', null, 
                                        ['id' => "phoneMobile", 
                                        'class' => 'form-control',
                                        'placeholder' => '1-222-33333333']) !!}
          </div>
          <div class="form-group">
            <label for="height">Height (cm)</label>
            {!! Form::text('height', null, 
                                        ['id' => "height", 
                                        'class' => 'form-control',
                                        'placeholder' => '190']) !!}
          </div>
          <div class="form-group">
              <label for="size">Size of t-shirt </br>(S, M, L, XL)</label>
            {!! Form::select('size', array('S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL'), null, 
                                        ['id' => "size", 
                                        'class' => 'form-control']) !!}
          </div>
          <div>
            <h3>EDUCATION, WORK EXPERIENCE, SKILLS</h3>
          </div>

          <div class="form-group">
            <label for="education">Educational Institution</label>
            {!! Form::text('education', null, 
                                        ['id' => "education", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Describe education']) !!}
          </div>
          <div class="form-group">
            <label for="study">Field of Study</label>
            {!! Form::text('study', null, 
                                        ['id' => "study", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Describe field of study']) !!}
          </div>

        <div class="form-group">
            <label for="earliestDate">The earliest J1 job start date </br>(mm, dd, yy)</label>
            <div class="input-group date" data-provide="datepicker">
                {!! Form::text('earliestDate', null,
                  ['id' => "earliestDate", 'class' => 'form-control',
                  'placeholder' => '05/20/2017']) !!}
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>

          <div class="form-group">
            <label for="latestDate">The latest J1 job end date </br>(mm, dd, yy)</label>
              <div class="input-group date" data-provide="datepicker">
                  {!! Form::text('latestDate', null,
                                        ['id' => "latestDate",
                                        'class' => 'form-control',
                                        'placeholder' => '10/20/2017']) !!}
                  <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </div>
              </div>
          </div>

          <div class="form-group">
            <label for="drivingExperience">Driving Experience</label>
            {!! Form::text('drivingExperience', null, 
                                        ['id' => "drivingExperience", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Driving Experience']) !!}
          </div>
          <div class="form-group">
            <label for="otherLanguage">What other language do you know?</label>
            {!! Form::text('otherLanguage', null, 
                                        ['id' => "otherLanguage", 
                                        'class' => 'form-control',
                                        'placeholder' => 'Russian, Kazakh']) !!}
          </div>
          <div class="form-group">
            <label for="beforeUS">Have you been to the United States before?</label>
            {!! Form::text('beforeUS', null, 
                                        ['id' => "beforeUS", 
                                        'class' => 'form-control',
                                        'placeholder' => 'No']) !!}
          </div>
          <div class="form-group">
            <label for="workExperience">Indicate the following information about each employer</br> or work experience you have:</label>
            {!! Form::textarea('workExperience', null, 
                                        ['id' => "workExperience", 
                                        'class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            <label for="skills">You hobbies/interests/skills/</br>Certificates</label>
            {!! Form::textarea('skills', null, 
                                        ['id' => "skills", 
                                        'class' => 'form-control']) !!}
          </div>

          <div>
              <h3>ADDITIONAL INFORMATION</h3>
          </div>

          <div class="form-group">
            <label for="state">Location to go</label>
              {!! Form::select('location_id',
              ["" => "Everywhere"] + $locations,
              null,
              ['class' => 'form-control']) !!}
          </div>

        <div class="form-group">
            <label for="youtube_url">Youtube profile URL</label>
            <div class="input-group">
                <div class="input-group-addon">https://www.youtube.com/embed/</div>
                {!! Form::text('youtube_url', null,
                                            ['id' => "youtube_url",
                                            'class' => 'form-control',
                                            'placeholder' => 'OyBO7gjymUY']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="sponsor_id">Sponsor</label>
            {!! Form::select('sponsor_id',
                ['' => 'Select sponsor'] + $sponsors->toArray(), null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="is_available">Available</label>
            {!! Form::select('is_available', [0 => 'no', 1 => 'yes'], 1, ['class' => 'form-control']) !!}
        </div>


          <button type="submit" class="btn btn-default">Submit</button>
          {!! Form::close() !!}
    </div>
</div>
@endsection
