<?php

namespace App\Policies;

use App\Models\CandidateLanguages;
use App\Models\User;

class LanguagePolicy
{
    public function update(User $user, CandidateLanguages $language): bool
    {
        return $user->id === $language->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CandidateLanguages $language): bool
    {
        return $user->id === $language->user_id;
    }
}
