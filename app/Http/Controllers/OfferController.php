<?php

namespace App\Http\Controllers;

use App\ApplicationCVForm;
use App\Mail\CompletedOffer;
use App\Offers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{

    public function showList($approved = 'not_approved')
    {
        $offers = Offers::approved($approved);
        return view('offers.list', compact('offers', 'approved'));
    }

    /**
     * add student to offers
     * @param Request $request
     * @return mixed
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        $student = ApplicationCVForm::findOrFail($data['student_id']);

        if($this->is_offer_exists($data))
            return \Response::json([
              'title' => 'info',
              'message' => $student->firstName . " " . $student->lastName . " already added to offers"
            ]);

        Offers::create($data);
        return \Response::json(['title' => 'success', 'message' => $student->firstName . " " . $student->lastName . " was added to offers"]);
    }


    /**
     * check if user already in offers
     * @param $data
     * @return bool
     */
    private function is_offer_exists($data)
    {
        $offer = Offers::where([
            'user_id' => $data['user_id'],
            'student_id' => $data['student_id']
        ])->first();
        if($offer) return true;
        return false;
    }

    private function setStudentAvailable($studentId){
        $student = ApplicationCVForm::findOrFail($studentId);
        if($student->is_available == false)
            $student->update(['is_available' => true]);
    }


    /**
     * delete student from auth user offers
     * @param Request $request
     * @return mixed
     */
    public function remove(Request $request)
    {
        $studentId = $request->get('studentId');
        $this->setStudentAvailable($studentId);

        $student = ApplicationCVForm::findOrFail($studentId);

        User::deleteOffer($studentId);

        return \Response::json(['title' => 'success', 'message' => $student->firstName . " " . $student->lastName . " was removed from offers"]);
    }

    /**
     * get student from auth user offers
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function get()
    {
        $students = User::activeOffers();
        $alreadyInOfferCart = true;
        $students_count = $students->count();
        return view('blocks.students-list', compact('students', 'alreadyInOfferCart', 'students_count'))->render();
    }


    /**
     * move user to completed tab
     * @param Request $request
     * @return mixed
     */
    public function setStudentUnvailable(Request $request)
    {
        $studentId = $request->get('student_id');

        #set status unvailable
        $student = ApplicationCVForm::findOrFail($studentId);
        $student->update(['is_available' => false]);

        #remove student from other offer carts
        User::detachStudentFromOtherEmployers($studentId);

        #send email if user is movied to completed
        Mail::to('elleryk@gmail.com')->queue(new CompletedOffer($student));
        return \Response::json([
            'title' => 'success',
            'message' => '<strong>Successfully added ' . $student->fullName .' to Offer Cart.</strong><br/>
                You can save or print the offer form by clicking on the <strong><a class="js_move_to_completed" href="/home#completed-tab">Offer Cart</a></sctrong> list'
        ]);
    }
    

    public function students()
    {
        $user = \Auth::user();
        $students = ApplicationCVForm::studentsForEmployer($user);
        $students_count = $students->count();
        return view('blocks.students-list-with-links', compact('students', 'students_count'))->render();
    }

    /**
     * upload signed pdf for students
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadSignedForm($student_id, Request $request)
    {
        $this->validate($request, [
            'formpdf' => 'required|mimes:pdf,jpg,jpeg,png',
        ]);
        $student = ApplicationCVForm::find($student_id);
        if(!$student) {
            return response()->json(['status' => "error", "message" => "User not found"], 404);
        }

        $file = $request->file('formpdf');
        $name = "student-" . $student->id . "." . $file->getClientOriginalExtension();
        Storage::disk('local')->putFileAs('uploads/students/' , $file, $name);

        $offer = Offers::where([
            'user_id' => auth()->id(),
            'student_id' => $student->id
        ])->first();
        $offer->update(['signed_form' => $name]);
        return response()->json(['status' => "success",  'message' => "Form successfully saved", 'offer_id' => $offer->id]);
    }

    public function getSignedForm($id)
    {
        $offer = Offers::findOrFail($id);
        $path = storage_path('app/uploads/students/'. $offer->signed_form);
        if (!\File::exists($path)){
            echo "File not found";
            return;
        }
        $mime = \File::mimeType($path);
        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="'.$offer->signed_form.'"'
        ]);
    }

    public function make_approve($offerId)
    {
        $offer = Offers::findOrFail($offerId);
        $offer->update(['is_approved' => true]);
        return response()->json(['status' => "success",  'message' => "Successfully"]);
    }


}
