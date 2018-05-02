<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceNowLocation;

class Asset extends BaseCrudModel
{

	//protected $table = "assets";
	protected $fillable = ['serial','part_id','vendor_id','warranty_id','location_id'];

/*
    public function location()
    {
        return $this->belongsTo('App\ServiceNowLocation', 'sys_id', 'location_id');
    }
/**/
	public function getLocation()
	{
		return ServiceNowLocation::find($this->location_id);
	}

}
