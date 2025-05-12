<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GoogleContactsService;
use Google_Client;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    protected $googleContactsService;

    public function __construct(GoogleContactsService $googleContactsService)
    {
        $this->googleContactsService = $googleContactsService;
    }

    public function redirect()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-credentials.json'));
        $client->addScope('https://www.googleapis.com/auth/contacts');
        $client->setRedirectUri(route('google.callback'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return redirect($client->createAuthUrl());
    }

    public function callback(Request $request)
    {
        if ($request->has('code')) {
            $client = new Google_Client();
            $client->setAuthConfig(storage_path('app/google-credentials.json'));
            $client->setRedirectUri(route('google.callback'));

            $token = $client->fetchAccessTokenWithAuthCode($request->code);

            auth()->user()->update([
                'google_access_token'     => $token['access_token'],
                'google_refresh_token'    => $token['refresh_token'],
                'google_token_expires_at' => now()->addSeconds($token['expires_in']),
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Compte Google connecté avec succès');
        }

        return redirect()->route('dashboard')
            ->with('error', 'Erreur lors de la connexion avec Google');
    }

    public function disconnect()
    {
        auth()->user()->update([
            'google_access_token'     => null,
            'google_refresh_token'    => null,
            'google_token_expires_at' => null,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Compte Google déconnecté avec succès');
    }

    public function isConnected()
    {
        return ! empty(auth()->user()->google_access_token);
    }
}