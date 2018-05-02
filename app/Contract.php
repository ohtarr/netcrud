<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceNowLocation;

class Contract extends BaseCrudModel
{
    protected $fillable = ['cid','partner_id','description'];
}
