<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends BaseCrudModel
{

	protected $fillable = ['manufacturer_id','part_number','list_price','weight'];


}
