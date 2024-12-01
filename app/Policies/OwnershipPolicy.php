<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class OwnershipPolicy
{    
    public function access(User $user, Model $model)
    {
        return $user->role === 'admin' || $model->user_id === $user->id;
    }
}
