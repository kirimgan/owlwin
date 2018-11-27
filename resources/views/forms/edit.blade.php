@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>JOB APPLICATION FORM/ STUDENT CV</h1>
            @include('layouts/form-errors')
            <div>
                <h3>PERSONAL INFORMATION</h3>
            </div>
            {!! Form::open(['url' => '/forms/edit/update/' . $entry->id, 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                <label for="firstName">First Name</label>
                {!! Form::text('firstName', $entry->firstName,
                                            ['id' => "firstName",
                                            'class' => 'form-control',
                                            'placeholder' => 'First Name']) !!}
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                {!! Form::text('lastName', $entry->lastName,
                                            ['id' => "lastName",
                                            'class' => 'form-control',
                                            'placeholder' => 'Last Name']) !!}
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                {!! Form::file('photo') !!}
                <img src="{{route('forms.getFormImage', $entry->photo)}}">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                {!! Form::text('country', $entry->country,
                                            ['id' => "country",
                                            'class' => 'form-control',
                                            'placeholder' => 'Country']) !!}
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                {!! Form::text('address', $entry->address,
                                            ['id' => "address",
                                            'class' => 'form-control',
                                            'placeholder' => 'Address']) !!}
            </div>
            <div class="form-group">
                <label for="language">Native Language</label>
                {!! Form::text('language', $entry->language,
                                            ['id' => "language",
                                            'class' => 'form-control',
                                            'placeholder' => 'Language']) !!}
            </div>
            <div class="form-group">
                <label for="size">English level</br>(Beginner, Intermediate, Advanced)</label>
                {!! Form::select('englishLevel', array('Beginner' => 'Beginner', 'Intermediate' => 'Intermediate', 'Advanced' => 'Advanced'), $entry->englishLevel,
                                            ['id' => "englishLevel",
                                            'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), $entry->gender,
                                            ['id' => "gender",
                                            'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="dateOfBirth">Date of Birth </label></br>(Month, Day, Year)</label>
                <div class="input-group date" data-provide="datepicker">
                    {!! Form::text('dateOfBirth', prepareDateForView($entry->dateOfBirth),
                        ['id' => "dateOfBirth", 'class' => 'form-control datepicker',
                        'placeholder' => 'Month/Day/Year']) !!}
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="email">E-mail</label>
                {!! Form::text('email', $entry->email,
                                            ['id' => "email",
                                            'class' => 'form-control',
                                            'placeholder' => 'E-mail']) !!}
            </div>
            <div class="form-group">
                <label for="skype">Skype</label>
                {!! Form::text('skype', $entry->skype,
                                            ['id' => "skype",
                                            'class' => 'form-control',
                                            'placeholder' => 'Skype id']) !!}
            </div>
            <div class="form-group">
                <label for="phoneHome">Phone Home Number </br>(country-city-number)</label>
                {!! Form::text('phoneHome', $entry->phoneHome,
                                            ['id' => "phoneHome",
                                            'class' => 'form-control',
                                            'placeholder' => '1-222-33333333']) !!}
            </div>
            <div class="form-group">
                <label for="phoneMobile">Phone Mobile Number </br>(country-city-number)</label>
                {!! Form::text('phoneMobile', $entry->phoneMobile,
                                            ['id' => "phoneMobile",
                                            'class' => 'form-control',
                                            'placeholder' => '1-222-33333333']) !!}
            </div>
            <div class="form-group">
                <label for="height">Height (cm)</label>
                {!! Form::text('height', $entry->height,
                                            ['id' => "height",
                                            'class' => 'form-control',
                                            'placeholder' => '190']) !!}
            </div>
            <div class="form-group">
                <label for="size">Size of t-shirt </br>(S, M, L, XL)</label>
                {!! Form::select('size', array('S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL'), $entry->size,
                                            ['id' => "size",
                                            'class' => 'form-control']) !!}
            </div>

            <div>
                <h3>EDUCATION, WORK EXPERIENCE, SKILLS</h3>
            </div>

            <div class="form-group">
                <label for="education">Educational Institution</label>
                {!! Form::text('education', $entry->education,
                                            ['id' => "education",
                                            'class' => 'form-control',
                                            'placeholder' => 'Describe education']) !!}
            </div>
            <div class="form-group">
                <label for="study">Field of Study</label>
                {!! Form::text('study', $entry->study,
                                            ['id' => "study",
                                            'class' => 'form-control',
                                            'placeholder' => 'Describe field of study']) !!}
            </div>


            <div class="form-group">
                <label for="latestDate">The earliest J1 job start date </br>(mm, dd, yy)</label>
                <div class="input-group date" data-provide="datepicker">
                    {!! Form::text('earliestDate', prepareDateForView($entry->earliestDate),
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
                    {!! Form::text('latestDate', prepareDateForView($entry->latestDate),
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
                {!! Form::text('drivingExperience', $entry->drivingExperience,
                                            ['id' => "drivingExperience",
                                            'class' => 'form-control',
                                            'placeholder' => 'Driving Experience']) !!}
            </div>
            <div class="form-group">
                <label for="otherLanguage">What other language do you know?</label>
                {!! Form::text('otherLanguage', $entry->otherLanguage,
                                            ['id' => "otherLanguage",
                                            'class' => 'form-control',
                                            'placeholder' => 'Russian, Kazakh']) !!}
            </div>
            <div class="form-group">
                <label for="beforeUS">Have you been to the United States before?</label>
                {!! Form::text('beforeUS', $entry->beforeUS,
                                            ['id' => "beforeUS",
                                            'class' => 'form-control',
                                            'placeholder' => 'No']) !!}
            </div>
            <div class="form-group">
                <label for="workExperience">Indicate the following information about each employer</br> or work
                    experience you have:</label>
                {!! Form::textarea('workExperience',  $entry->workExperience,
                                            ['id' => "workExperience",
                                            'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="skills">You hobbies/interests/skills/</br>Certificates</label>
                {!! Form::textarea('skills', $entry->skills,
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
                $entry->location_id,
                ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="youtube_url">Youtube profile URL</label>
                <div class="input-group">
                    <div class="input-group-addon">https://www.youtube.com/embed/</div>
                        {!! Form::text('youtube_url', getYoutubeHash($entry->youtube_url),
                                                    ['id' => "youtube_url",
                                                    'class' => 'form-control',
                                                    'placeholder' => 'OyBO7gjymUY']) !!}
                    </div>
            </div>

            <div class="form-group">
                <label for="sponsor_id">Sponsor</label>
                {!! Form::select('sponsor_id',
                    ['' => 'Select sponsor'] + $sponsors->toArray(), $entry->sponsor_id, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="is_available">Available</label>
                {!! Form::select('is_available',
                    [0 => 'no', 1 => 'yes'],
                    $entry->is_available,
                    ['class' => 'form-control']) !!}
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
