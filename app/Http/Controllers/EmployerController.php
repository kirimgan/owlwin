<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\EmployerRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\ApplicationCVForm;
use App\User;
use App\Locations;
use App\States;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $locations = Locations::getForSelectBox();
        return view('employers.create', compact('locations'));
    }

    public function store(EmployerRequest $request)
    {
        $data = $request->all();
        $data['password'] = str_random(11);
        $data['is_employer'] = 1;
        $data['location_id'] = ($data['location_id']) ? $data['location_id'] : null;
        $user = User::create($data);

        flash('Employer has been created', 'success');

        return view('employers.show', compact('user'));
    }

    public function showList()
    {
        $users = User::where(['is_employer' => 1])->paginate(10);

        return view('employers.list', [
            'users' => $users
            ]
        );
    }

    public function edit($id)
    {
        $locations = Locations::getForSelectBox();
        $entry = User::findOrFail($id);

        #get students by employer location
        $students = ApplicationCVForm::studentsForEmployer($entry, true);
        return view('employers.edit-employer', compact('entry', 'locations', 'students'));
    }

    public function update(EmployerRequest $request, $id)
    {

        $entry = User::findOrFail($id);
        $fields = $request->all();
        $fields['user_id'] = \Auth::user()->id;
        $fields['location_id'] = ($fields['location_id']) ? $fields['location_id'] : null;

        $entry->students()->sync((array) $request->input('students'));

        $entry->update($fields);
        flash('Employer has been updated', 'success');
        return redirect('/employer/edit-employer/' . $entry->id );
    }

     public function delete($id) {
        $user = User::find($id);
        $user->delete();
        return back();
        
    }

}
