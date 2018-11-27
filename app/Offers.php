<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = [
        'user_id', 'student_id', 'signed_form','is_approved'
    ];

    public function employer()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function participant()
    {
        return $this->hasOne('App\ApplicationCVForm', 'id', 'student_id');
    }

    public function scopeOffersData($query)
    {
        return $query->select('offers.id as offer_id', 'offers.student_id', 'offers.signed_form',
        'applicationcv_form_entries.*', 'sponsors.name as sponsor_name', 'sponsors.offer_form as offer_form')
        ->join('applicationcv_form_entries', 'applicationcv_form_entries.id', '=', 'offers.student_id')
        ->leftJoin('sponsors', 'sponsors.id', '=', 'applicationcv_form_entries.sponsor_id');
    }

    public static function approved($approved = 'approved')
    {
        return self::with('employer', 'participant')
            ->where('is_approved', $approved == 'approved' ? true : false)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
    
}
