<?php

namespace App\Http\Controllers;

use App\Http\Requests\SponsorRequest;
use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::paginate(10);
        return view('sponsors.index', compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sponsor = new Sponsor();
        return view('sponsors.create', compact('sponsor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SponsorRequest $request)
    {
        #create sponsor
        $name = $request->get('name');
        $sponsor = Sponsor::create([
            'name' => $name
        ]);

        #if there is a pdf - upload it and save to database path
        $file = $request->file('offer_form');
        if($file){
            $fileName = str_slug($name, '-') . "-" . $sponsor->id ."." . $file->getClientOriginalExtension();
            Storage::disk('local')->put('uploads/sponsors/' . $fileName,  \File::get($file));
            $sponsor->update([
              'offer_form' => $fileName
            ]);
        }

        flash('Sponsor has been created', 'success');

        return redirect(url('sponsors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('sponsors.edit', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SponsorRequest $request, $id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $name = $request->get('name');
        $file = $request->file('offer_form');

        $data = [
          'name' => $name
        ];

        if($file){
            #delete previous pdf
            $this->deletePreviousFile($sponsor);

            $fileName = str_slug($name, '-') . "-" . $id . "." . $file->getClientOriginalExtension();
            Storage::disk('local')->put('uploads/sponsors/' . $fileName,  \File::get($file));
            $data['offer_form'] = $fileName;
        }

        $sponsor->update($data);
        flash('Sponsor has been updated', 'success');

        return redirect(url('sponsors'));
    }

    private function deletePreviousFile(Sponsor $sponsor)
    {
        if($sponsor->offer_form && Storage::disk('local')->has('uploads/sponsors/' . $sponsor->offer_form)){
            Storage::delete('uploads/sponsors/' . $sponsor->offer_form);
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $this->deletePreviousFile($sponsor);
        $sponsor->delete();
        flash('Sponsor has been deleted', 'success');
        return back();
    }

    public function viewPdf($id)
    {
        $entry = Sponsor::findOrFail($id);
        $path = storage_path('app/uploads/sponsors/'. $entry->offer_form);
        if (!\File::exists($path)){
            echo "File not found";
            return;
        }
        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$entry->offer_form.'"'
        ]);
    }
}
