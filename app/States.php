<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = 'states';
    protected $guarded  = array('id');
    public $primaryKey = 'id';
    public function countries()
    {
        return $this->belongsTo('App\Models\Countries');
    }
    public function cities()
    {
        return $this->hasMany('App\Models\Cities');
    }
    public function getAllStatesByCountryID($cid)
    {
        //if (isset(Auth::user()->user_type) && (Auth::user()->user_type == 'Staff')) {
        return $this
            //->join('countries', 'states.country_id', '=', 'countries.id')
            ->where('country_id', $cid)
            ->get()->toArray();
        // }
        // else{
        //     return $this->model
        //     ->get();
        // }

    }

    public function getStateByID($stateid)
    {
        return $this
            ->where('id', $stateid)
            ->first();
    }
}