<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SocialAccountHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * Redirect the user to the provider`s authentication page.
     *
     * @param string $provider provider name (e.g. "github")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information given by the provider
     *
     * @param SocialAccountHelper $accountService
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(SocialAccountHelper $accountService, $provider)
    {
        $user = Socialite::with($provider)->user();

        $authUser = $accountService->findOrCreate($user, $provider);

        Auth::login($authUser, true);

        return redirect()->to('/');
    }
}
