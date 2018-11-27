<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'location_id', 'is_employer', 'company_info'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function location()
    {
        return $this->hasOne('App\Locations', 'id', 'location_id');
    }

    public function offers()
    {
        return $this->hasMany('App\Offers', 'user_id', 'id');
    }
    /**
     * reletion for employer
     * emploeyr has many students, and student has many employers
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany('App\ApplicationCVForm', 'employer_student',  'user_id', 'student_id');
    }


    public static function activeOffers()
    {
        return \Auth::user()
            ->offers()
            ->offersData()
            ->orderBy('offers.created_at', 'desc')
            ->get();
    }

    public static function activeOffersCount()
    {
        return \Auth::user()->offers()->offersData()
            ->count();
    }

    public static function completedOffersCount()
    {
        return \Auth::user()->offers()
            ->offersData()
            ->where('applicationcv_form_entries.is_available', false)
            ->count();
    }



    /**
     * delete student from users offers
     * @param $studentId
     */
    public static function deleteOffer($studentId)
    {
        auth()->user()
            ->offers()
            ->where('student_id', $studentId)
            ->firstOrFail()->delete();
    }

    public static function detachStudentFromOtherEmployers($studentId)
    {
        Offers::where('student_id', $studentId)
          ->where('user_id', '<>', auth()->id())
          ->delete();

        \DB::table('employer_student')
          ->where('user_id', '<>', auth()->id())
          ->where('student_id', $studentId)
          ->delete();
    }


}
