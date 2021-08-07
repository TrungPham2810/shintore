<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizationRule extends Model
{
    protected $guarded = [];
    public function ruleParent()
    {
        return $this->belongsTo(AuthorizationRule::class, 'parent_id', 'id');
    }

    public function ruleChildren()
    {
        return $this->hasMany(AuthorizationRule::class, 'parent_id');
    }

    public function roles()
    {
        return $this->belongsToMany(AuthorizationRole::class, 'authorization_role_rules', 'rule_id', 'role_id')->withTimestamps();
    }
}
