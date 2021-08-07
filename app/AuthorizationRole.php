<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizationRole extends Model
{
    protected $guarded = [];

    public function rules()
    {
        return $this->belongsToMany(AuthorizationRule::class, 'authorization_role_rules', 'role_id', 'rule_id')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(AuthorizationRoleUser::class, 'authorization_role_users', 'role_id', 'user_id')->withTimestamps();
    }
}
