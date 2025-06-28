<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceNote extends Model
{
    protected $guarded = [];
    public function serviceRequest()
    {
        $this->belongsTo(ServiceRequest::class);
    }
}
