@extends('layouts.email')

@section('body')
     <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;">The new user is added to offer cart</h1>

     <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
         <table style="font-size: 14px;">
            <tr>
                <td>Student:</td>
                <td>{{ $student->firstName  }} {{ $student->lastName  }}</td>
            </tr>
         <tr>
             <td>Country:</td>
             <td>{{ $student->country }}</td>
         </tr>
         <tr>
             <td>Address:</td>
             <td>{{ $student->address }}</td>
         </tr>
         <tr>
             <td>Native language:</td>
             <td>{{ $student->language }}</td>
         </tr>
         <tr>
             <td>English level:</td>
             <td>{{ $student->englishLevel }}</td>
         </tr>
         <tr>
             <td>Gender:</td>
             <td>{{ $student->gender }}</td>
         </tr>
         <tr>
             <td>Date of birth:</td>
             <td>{{ prepareDateForView($student->dateOfBirth) }}</td>
         </tr>
         <tr>
             <td>Email:</td>
             <td>{{ $student->email }}</td>
         </tr>
         <tr>
             <td>Skype:</td>
             <td>{{ $student->skype }}</td>
         </tr>
         <tr>
             <td colspan="2" align="center">
                 <img src="{{route('forms.getFormImage', $student->photo)}}">
             </td>
         </tr>
        </table>
     </p>

     <table style="width: 100%; margin: 30px auto; padding: 0; text-align: center;" align="center" width="100%" cellpadding="0" cellspacing="0">
         <tr>
             <td align="center">
                 <a href="{{ url('home#completed-tab') }}"
                    style="background-color: #f05f40; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                  border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                     text-align: center; text-decoration: none; -webkit-text-size-adjust: none;"
                    class="button"
                    target="_blank">
                     Check your cart
                 </a>
             </td>
         </tr>
     </table>

@endsection