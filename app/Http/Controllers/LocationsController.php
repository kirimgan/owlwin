<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Request\LocationRequest;
use Illuminate\Http\Response;
use App\ApplicationCVForm;
use App\User;
use App\Locations;
use App\States;


class LocationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $states = States::pluck('name', 'id');

        return view('locations.create', [
            'states' => $states
            ]
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = Locations::create($data);

        flash('Location has been created', 'success');

        return redirect(url('locations/list'));
    }

    public function showList()
    {
        $locations = Locations::paginate(10);
        return view('locations.list', compact('locations'));
    }

    public function edit($id)
    {
        $locations = Locations::all();
        $locations = $locations->toArray();
        $states = States::pluck('name', 'id');
        

        $locationsArray = array();
        

        foreach ($locations as $l) {
            if (empty($l['neighbourhood'])) {
                $locationsArray[$l['id']] = $l['area'];
            } else {
                $locationsArray[$l['id']] = $l['area'] . ' - ' . $l['neighbourhood'];
            }
        }

        $entry = Locations::findOrFail($id);

        return view('locations.edit-location', [
            'entry' => $entry,
            'locations' => $locationsArray,
            'states' => $states
            ]
        );
    }

    public function update(Requests\LocationRequest $request, $id)
      {
        /*$data = $request->all();

        $user = Locations::update($data);

        flash('Location has been updated', 'success');*/
        $entry = Locations::findOrFail($id);
        $fields = $request->all();
        $fields['user_id'] = \Auth::user()->id;
        

        $entry->update($fields);

        return redirect('locations/list');
    }

    public function delete($id) {
        $location = Locations::find($id);
        $location->delete();
        return back();
        
    }
}
