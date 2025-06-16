<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends Model
{
    use SoftDeletes;
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'status',
        'group',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
        'status' => 'boolean',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions');
    }
    // protected static function booted(): void
    // {
    //     static::addGlobalScope('delete', function (Builder $builder) {
    //         $builder->where('deleted_at', null);
    //     });
    // }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }
}
