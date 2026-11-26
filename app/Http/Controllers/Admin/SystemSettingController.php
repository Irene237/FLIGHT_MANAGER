<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SystemSettingController extends Controller
{
    /**
     * Afficher les paramètres système.
     */
    public function index()
    {
        // Récupérer tous les paramètres enregistrés.
        // Les indexer par leur clé pour faciliter leur utilisation dans Blade.
        $settings = SystemSetting::all()->keyBy('key');

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Enregistrer ou mettre à jour les paramètres système.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([

            // Configuration générale
            'app_name' => [
                'required',
                'string',
                'max:100',
            ],

            'contact_email' => [
                'required',
                'email',
                'max:255',
            ],

            'currency' => [
                'required',
                'string',
                'max:30',
            ],

            // Moyens de paiement
            'payment_mtn' => [
                'required',
                Rule::in(['0', '1']),
            ],

            'payment_orange' => [
                'required',
                Rule::in(['0', '1']),
            ],

            'payment_card' => [
                'required',
                Rule::in(['0', '1']),
            ],

            // Notifications
            'notify_booking_confirmation' => [
                'required',
                Rule::in(['0', '1']),
            ],

            'notify_departure_reminder' => [
                'required',
                Rule::in(['0', '1']),
            ],

            'notify_flight_delay' => [
                'required',
                Rule::in(['0', '1']),
            ],

            // Sécurité
            'two_factor_auth' => [
                'required',
                Rule::in(['0', '1']),
            ],

            'session_timeout' => [
                'required',
                'integer',
                'min:5',
                'max:1440',
            ],

            'login_logs' => [
                'required',
                Rule::in(['0', '1']),
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | CONFIGURATION GÉNÉRALE
        |--------------------------------------------------------------------------
        */

        SystemSetting::setValue(
            'app_name',
            $validated['app_name'],
            'general',
            'text',
            'Nom de l’application'
        );

        SystemSetting::setValue(
            'contact_email',
            $validated['contact_email'],
            'general',
            'email',
            'Adresse e-mail de contact'
        );

        SystemSetting::setValue(
            'currency',
            $validated['currency'],
            'general',
            'text',
            'Devise utilisée par l’application'
        );

        /*
        |--------------------------------------------------------------------------
        | PAIEMENTS
        |--------------------------------------------------------------------------
        */

        SystemSetting::setValue(
            'payment_mtn',
            $validated['payment_mtn'],
            'payments',
            'boolean',
            'Activation de MTN Mobile Money'
        );

        SystemSetting::setValue(
            'payment_orange',
            $validated['payment_orange'],
            'payments',
            'boolean',
            'Activation de Orange Money'
        );

        SystemSetting::setValue(
            'payment_card',
            $validated['payment_card'],
            'payments',
            'boolean',
            'Activation du paiement par carte bancaire'
        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */

        SystemSetting::setValue(
            'notify_booking_confirmation',
            $validated['notify_booking_confirmation'],
            'notifications',
            'boolean',
            'Notification de confirmation de réservation'
        );

        SystemSetting::setValue(
            'notify_departure_reminder',
            $validated['notify_departure_reminder'],
            'notifications',
            'boolean',
            'Rappel avant le départ'
        );

        SystemSetting::setValue(
            'notify_flight_delay',
            $validated['notify_flight_delay'],
            'notifications',
            'Notification en cas de retard de vol'
        );

        /*
        |--------------------------------------------------------------------------
        | SÉCURITÉ
        |--------------------------------------------------------------------------
        */

        SystemSetting::setValue(
            'two_factor_auth',
            $validated['two_factor_auth'],
            'security',
            'boolean',
            'Activation de l’authentification à deux facteurs'
        );

        SystemSetting::setValue(
            'session_timeout',
            $validated['session_timeout'],
            'security',
            'integer',
            'Durée maximale de session en minutes'
        );

        SystemSetting::setValue(
            'login_logs',
            $validated['login_logs'],
            'security',
            'boolean',
            'Activation du journal des connexions'
        );

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Les paramètres système ont été enregistrés avec succès.');
    }
}