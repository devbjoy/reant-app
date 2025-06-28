<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'category',
        'description',
        'status',
        'images',
        'tenant_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function scopeUser($query)
    {
        return $query->where('tenant_id', auth()->guard('tenant')->user()->id);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function notes()
    {
        return $this->hasMany(ServiceNote::class);
    }

}
