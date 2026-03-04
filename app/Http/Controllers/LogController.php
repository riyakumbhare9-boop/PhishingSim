<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phishinglog;
use App\Models\Clicklog;
use Illuminate\View\View;

class LogController extends Controller
{
    public function phishingLogs(Request $request): View
    {
        $query = Phishinglog::with('campaign');
        
        if ($request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        $logs = $query->latest()->paginate(15);
        
        return view('logs.phishing', ['logs' => $logs]);
    }

    public function clickLogs(Request $request): View
    {
        $query = Clicklog::with('campaign');
        
        if ($request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        $logs = $query->latest()->paginate(15);
        
        return view('logs.clicks', ['logs' => $logs]);
    }
}
