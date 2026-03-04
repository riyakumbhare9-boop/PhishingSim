<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Campaign;
use App\Mail\PhishingEmail;
use Illuminate\Support\Facades\Mail;

class campaigncontoller extends Controller
{
    public function index(): View {
        return view('campaigns.index', [
            'campaigns' => Campaign::latest()->get()
        ]);
    }
    
    public function create(): View {
        return view("campaigns.create");
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'subject' => "required",
            'email_body' => "required",
            'phishing_link' => "required|url",
            'target_emails' => "nullable|string",
        ]);

        Campaign::create([
            "subject" => $request->subject,
            "email_body" => $request->email_body,
            "phishing_link" => $request->phishing_link,
            "status" => "inactive",
            "target_emails" => $request->target_emails,
        ]);

        return redirect()->route('campaigns.index')
                         ->with('success','Campaign created successfully.');
    }

    public function show(Campaign $campaign): View {
        return view('campaigns.show', ['campaign' => $campaign]);
    }

    public function edit(Campaign $campaign): View {
        return view('campaigns.edit', ['campaign' => $campaign]);
    }

    public function update(Request $request, Campaign $campaign): RedirectResponse {
        $request->validate([
            'subject' => "required",
            'email_body' => "required",
            'phishing_link' => "required|url",
            'status' => "required|in:active,inactive",
            'target_emails' => "nullable|string",
        ]);

        $campaign->update([
            "subject" => $request->subject,
            "email_body" => $request->email_body,
            "phishing_link" => $request->phishing_link,
            "status" => $request->status,
            "target_emails" => $request->target_emails,
        ]);

        return redirect()->route('campaigns.show', $campaign->id)
                         ->with('success','Campaign updated successfully.');
    }

    public function destroy(Campaign $campaign): RedirectResponse {
        $campaign->delete();
        return redirect()->route('campaigns.index')
                         ->with('success','Campaign deleted successfully.');
    }

    public function sendEmails(Campaign $campaign): RedirectResponse {
        $emails = $campaign->getTargetEmailsArray();
        
        if (empty($emails)) {
            return redirect()->route('campaigns.show', $campaign->id)
                           ->with('error', 'No target emails specified for this campaign.');
        }

        $sentCount = 0;
        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new PhishingEmail($campaign, $email));
                $sentCount++;
            } catch (\Exception $e) {
                // Log email sending errors
            }
        }

        // Change campaign status to active
        $campaign->update(['status' => 'active']);

        return redirect()->route('campaigns.show', $campaign->id)
                         ->with('success', "Successfully sent $sentCount emails from this campaign.");
    }
}
