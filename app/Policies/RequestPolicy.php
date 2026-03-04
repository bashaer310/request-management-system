<?php

namespace App\Policies;

use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Models\Request;
use App\Models\User;
use HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RequestPolicy
{

    public function view(User $user, Request $request): bool
    {
        return $user->id === $request->created_by || $user->role === UserRole::MANAGER;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::USER;
    }

    public function approve(User $user, Request $request): bool
    {
        return $user->role === UserRole::MANAGER && $request->status == 'pending';
    }

    public function reject(User $user, Request $request): bool
    {
        return $user->role === UserRole::MANAGER && $request->status == 'pending';
    }
}



