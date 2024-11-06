<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Job;

class JobPolicy
{
    public function create(User $user)
    {
        return $user->user_type === 'recruiter';
    }

    public function update(User $user, Job $job)
    {
        return $user->user_type === 'recruiter';
    }

    public function delete(User $user, Job $job)
    {
        return $user->user_type === 'recruiter';
    }
}
