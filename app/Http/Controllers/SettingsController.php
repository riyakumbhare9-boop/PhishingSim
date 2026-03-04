<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                return redirect('/dashboard')->with('error', 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function index(): View
    {
        $settings = [
            'app_name' => config('app.name'),
            'phishing_domain' => env('PHISHING_DOMAIN', 'localhost'),
            'email_from' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
        ];
        
        return view('admin.settings', ['settings' => $settings]);
    }

    public function update(Request $request): RedirectResponse
    {
        // This is a simplified version. In production, you would store settings in a database
        // and update the .env file appropriately with proper validation.
        
        return redirect()->route('admin.dashboard')
                       ->with('success', 'Settings updated successfully.');
    }
}
