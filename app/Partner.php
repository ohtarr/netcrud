<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceNowLocation;

class Partner extends BaseCrudModel
{
	protected $fillable = ['name','discount_percent'];

}
