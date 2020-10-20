<?php


namespace App\Helpers;

use App\Models\SocialAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialAccountHelper
{

    /**
     * Searches for linked social account by given Socialite user instance
     * If there is no such then links existing User record with same email to new social account record
     * Or creates new User with linked social account record
     *
     * @param SocialUser $socialUser
     * @param $provider
     * @return mixed
     */
    public function findOrCreate(SocialUser $socialUser, $provider)
    {
        $account = SocialAccount::where('provider_name', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $socialUser->getEmail(),
                    'name' => $socialUser->getName(),
                ]);
            }

            $user->socialAccounts()->create([
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;
        }
    }
}
