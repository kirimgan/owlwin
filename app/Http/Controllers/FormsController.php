<?php

namespace App\Http\Controllers;

use App\Offers;
use App\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ApplicationCVForm;
use App\Locations;

class FormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entries = ApplicationCVForm::select("applicationcv_form_entries.*", "o.id as offer_id", "o.signed_form")
                ->leftJoin('offers as o', function ($join) {
                    $join->on('o.student_id', '=', 'applicationcv_form_entries.id')
                        ->where('applicationcv_form_entries.is_available', '=', false);
                })->latest()->paginate(20);
        return view('forms.index', compact('entries'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $sponsors = Sponsor::all()->pluck('name', 'id');
        $locations = Locations::getForSelectBox();

        return view('forms.create', compact('sponsors', 'locations'));
    }

    

    public function edit($id)
    {
        if(url()->previous() != url()->current()){
            session()->put('backUrl', url()->previous());
        } ; #set back url
        $sponsors = Sponsor::all()->pluck('name', 'id');
        $locations = Locations::getForSelectBox();
        $entry = ApplicationCVForm::findOrFail($id);

        return view('forms.edit', compact('entry', 'locations', 'sponsors'));
    }

    public function makePdf(Requests\ApplicationCvRequest $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png'
        ]);

        $fields = $request->all();
        $fields['sponsor_id'] = ($fields['sponsor_id']) ? $fields['sponsor_id'] : NULL;
        $fields['location_id'] = ($fields['location_id']) ? $fields['location_id'] : NULL;

        $fields['user_id'] = \Auth::user()->id;
        $fields['pdf_form_name'] = time() . md5($fields['firstName'] . $fields['lastName'] ) . '.pdf';

        $fields['dateOfBirth'] = prepareDateForDB($fields['dateOfBirth']);
        $fields['earliestDate'] = prepareDateForDB($fields['earliestDate']);
        $fields['latestDate'] = prepareDateForDB($fields['latestDate']);

        $file = $request->file('photo');
        $thumbImg = \Image::make($file->getRealPath())->fit(150, 150);
        $thumbImg->save($file->getRealPath(), 80);
        $extension = $file->getClientOriginalExtension();
        \Storage::disk('local')->put('uploads/photos/' . $file->getFilename() . '.' . $extension,  \File::get($file));
        $fields['mime'] = $file->getClientMimeType();
        $fields['original_filename'] = $file->getClientOriginalName();
        $fields['photo'] = $file->getFilename().'.'.$extension;

        ApplicationCVForm::create($fields);
        flash('Student has been created', 'success');
        return redirect('/forms');
    }

    public function viewPdf($id)
    {
        $entry = ApplicationCVForm::findOrFail($id);
        $entry->photoUrl = '../storage/app/uploads/photos/'. $entry->photo;

        $pdf = \PDF::loadView('forms.pdf-form', $entry);

        return @$pdf->stream($entry->firstName . $entry->lastName . '.pdf');
    }

    public function getImage($filename) {
        $entry = ApplicationCVForm::where('photo', '=', $filename)->firstOrFail();
        $file = \Storage::disk('local')->get('uploads/photos/' . $entry->photo);
 
        return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
    }



    public function update(Requests\ApplicationCvRequest $request, $id)
    {
        $this->validate($request, [
            'photo' => 'mimes:jpg,jpeg,png'
        ]);

        $entry = ApplicationCVForm::findOrFail($id);
        $fields = $request->all();
        $fields['sponsor_id'] = ($fields['sponsor_id']) ? $fields['sponsor_id'] : NULL;
        $fields['location_id'] = ($fields['location_id']) ? $fields['location_id'] : NULL;

        #if changed availability from false to true
        # make user available and delete from other offers
        if(!$entry->is_available && $fields['is_available']){
            Offers::where(['student_id' => $entry->id])->delete();
        }

        $fields['dateOfBirth'] = prepareDateForDB($fields['dateOfBirth']);
        $fields['earliestDate'] = prepareDateForDB($fields['earliestDate']);
        $fields['latestDate'] = prepareDateForDB($fields['latestDate']);

        $fields['user_id'] = \Auth::user()->id;
        $pdfFormName = time() . md5($fields['firstName'] . $fields['lastName'] ) . '.pdf';

        $file = $request->file('photo');
        if ($file) {
            $thumbImg = \Image::make($file->getRealPath())->fit(150, 150);
            $thumbImg->save($file->getRealPath(), 80);
            $extension = $file->getClientOriginalExtension();
            \Storage::disk('local')->put('uploads/photos/' . $file->getFilename() . '.' . $extension,  \File::get($file));
            $fields['mime'] = $file->getClientMimeType();
            $fields['original_filename'] = $file->getClientOriginalName();
            $fields['photo'] = $file->getFilename().'.'.$extension;
        } else {
            $fields['photo'] = $entry->photo;
        }

        $fields['pdf_form_name'] = $pdfFormName;

        $entry->update($fields);


        flash('Student has been updated', 'success');

        $backUrl = session('backUrl');
        if($backUrl){
            session()->forget('backUrl');
            return redirect($backUrl);
        }

        return back();
    }

    public function delete($id) {
        #delete student
        $student =  ApplicationCVForm::findOrFail($id);
        if($student->delete()){
            #delete students in offers
            Offers::where('student_id', $id)->delete();
        }
        flash('Successfully', 'success');
        return back();
    }
}
