<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Offers;
use App\Sponsor;
use App\ApplicationCVForm;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if ($user->is_employer) {
            $students = ApplicationCVForm::studentsForEmployer($user);
            $students_count = $students->total();
            $activeOffersCount = User::activeOffersCount(); #get completed count
            return view('home', compact('students', 'students_count', 'activeOffersCount'));
        } else {
            return view('admin-home');
        }
    }

    public function getImage($filename) {
        $entry = ApplicationCVForm::where('photo', '=', $filename)->firstOrFail();
        $file = \Storage::disk('local')->get('uploads/photos/' . $filename);
 
        return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
    }

    public function viewPdf($id)
    {
        $entry = ApplicationCVForm::findOrFail($id);
        $entry->photoUrl = '../storage/app/uploads/photos/'. $entry->photo;

        $pdf = \PDF::loadView('forms.pdf-form', $entry);

        return @$pdf->stream($entry->firstName . $entry->lastName . '.pdf');
    }

    public function getSponsorForm($filename) {
        $entry = Sponsor::where('offer_form', '=', $filename)->firstOrFail();
        $file = \Storage::disk('local')->get('uploads/sponsors/' . $entry->offer_form);
 
        return (new Response($file, 200))
              ->header('Content-Type', 'application/pdf');
    }
}
