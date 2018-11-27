<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplicationCVForm extends Model
{
    protected $table = 'applicationcv_form_entries';

    protected $fillable = [
        'firstName',
        'lastName',
        'photo',
        'mime',
        'original_filename',
        'country',
        'address',
        'language',
        'gender',
        'dateOfBirth',
        'email',
        'skype',
        'phoneHome',
        'phoneMobile',
        'englishLevel',
        'height',
        'size',
        'education',
        'study',
        'earliestDate',
        'latestDate',
        'swimming',
        'drivingExperience',
        'otherLanguage',
        'beforeUS',
        'workExperience',
        'skills',
        'user_id',
        'pdf_form_name',
        'location_id',
        'youtube_url',
        'sponsor_id',
        'is_available'
    ];

    protected $appends = array('age', 'fullName');

    public function employers()
    {
        return $this->belongsToMany('App\User', 'employer_student', 'student_id', 'user_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('applicationcv_form_entries.is_available', true);
    }

    public function getAgeAttribute($value)
    {
        return Carbon::parse($this->dateOfBirth)->diff(Carbon::now())->format('%y');
    }

    public function getFullNameAttribute($value)
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function location()
    {
        return $this->hasOne('App\Locations', 'id', 'location_id');
    }

    /**
     * get student for employer by location id
     * @param $user
     * @param bool $getAll - if false then get students by employer list
     * if true then get students without list
     * @return mixed
     */
    public static function studentsForEmployer($user, $getAll = false)
    {
        $activeUsersOffers = User::activeOffers()->pluck('student_id');
        $students = ApplicationCVForm::select('applicationcv_form_entries.*', 'applicationcv_form_entries.id as student_id',
          'sponsors.name as sponsor_name', 'sponsors.offer_form as offer_form',
          'st.name as state', 'loc.area', 'loc.neighbourhood')
          ->whereNotIn('applicationcv_form_entries.id', $activeUsersOffers)
          ->orderBy('youtube_url', 'desc')
          ->available()
          ->leftJoin('locations as loc', 'applicationcv_form_entries.location_id', '=', 'loc.id')
          ->leftJoin('states as st', 'st.id', '=', 'loc.state_id')
          ->leftJoin('sponsors', 'sponsors.id', '=', 'applicationcv_form_entries.sponsor_id');


        $location = $user->location;
        $where = "";
        if($location){
            $state = $location->state->name;
            $area = $location->area;
            $neighbourhood = $location->neighbourhood;

            #students with all locations
            #students with the same state
            $where = ' (( applicationcv_form_entries.location_id IS NULL ) OR (st.name="' . $state . '"';
            #students with the same area of with all area
            if($area){
                $where .= " AND (loc.area='' OR loc.area='" . $area ."')";
            } else {
                $where .= " AND (loc.area='')";
            }
            #students with the same neighbourhood of with all neighbourhood
            if($neighbourhood){
                $where .= " AND (loc.neighbourhood='' OR loc.neighbourhood='" . $neighbourhood ."')";
            } else {
                $where .= " AND (loc.neighbourhood='')";
            }
            $where .= ' )) ';
        }
        if($where)
            $students = $students->whereRaw($where);

        $activeStudents = $user->students->pluck('id')->toArray();
        if(!$getAll && count($activeStudents)){
            $students = $students->whereIn('applicationcv_form_entries.id', $activeStudents);
        }

        return $students->paginate(20);
    }

}
