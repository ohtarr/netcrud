<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceNowLocation;

class Contact extends BaseCrudModel
{
    protected $fillable = ['name','email','phone','description','partner_id'];
}
