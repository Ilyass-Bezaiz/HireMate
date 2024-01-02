<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkExperience;

class WorkExperiencePolicy
{
    public function view(User $user, WorkExperience $experience)
    {
        return $user->id === $experience->user_id;
    }

    public function update(User $user, WorkExperience $experience)
    {
        return $user->id === $experience->user_id;
    }

    public function delete(User $user, WorkExperience $experience)
    {
        return $user->id === $experience->user_id;
    }
}
