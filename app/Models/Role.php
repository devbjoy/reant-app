<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Role extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'status'];
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $table = 'roles';
    protected $primaryKey = 'id';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }
}
