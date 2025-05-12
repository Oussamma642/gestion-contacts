<?php

// app/Services/GoogleContactsService.php
namespace App\Services;

use Google\Client;
use Google\Service\People;
use Google\Service\People\Person;
use Google\Service\People\Name;
use Google\Service\People\EmailAddress;
use Google\Service\People\PhoneNumber;
use Illuminate\Support\Facades\Log;

class GoogleContactsService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google-credentials.json'));
        $this->client->addScope('https://www.googleapis.com/auth/contacts');
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
        $this->service = new People($this->client);
    }

    public function setAccessToken($accessToken)
    {
        $this->client->setAccessToken($accessToken);

        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $newToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                // Mettre à jour le token dans la base de données
                auth()->user()->update([
                    'google_access_token'     => $newToken['access_token'],
                    'google_token_expires_at' => now()->addSeconds($newToken['expires_in']),
                ]);
                return $newToken;
            }
            throw new \Exception('Token d\'accès expiré et pas de token de rafraîchissement');
        }
    }

    public function createContact($contactData)
    {
        try {
            $person = new Person();

            // Configuration du nom
            $name = new Name();
            $name->setGivenName($contactData['name']);
            $person->setNames([$name]);

            // Configuration de l'email
            $email = new EmailAddress();
            $email->setValue($contactData['email']);
            $person->setEmailAddresses([$email]);

            // Configuration du téléphone
            $phone = new PhoneNumber();
            $phone->setValue($contactData['phone']);
            $person->setPhoneNumbers([$phone]);

            return $this->service->people->createContact($person);
        } catch (\Exception $e) {
            Log::error('Erreur Google Contacts: ' . $e->getMessage());
            throw $e;
        }
    }
}