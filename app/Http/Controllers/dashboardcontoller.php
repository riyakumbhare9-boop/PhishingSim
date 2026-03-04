<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phishinglog;
use App\Models\Clicklog;
use App\Models\Campaign;
use Illuminate\View\View;

class dashboardcontoller extends Controller
{
    public function index(): View{
        $totalCampaigns = Campaign::count();
        $activeCampaigns = Campaign::where('status', 'active')->count();
        $totalCredentialsCapture = Phishinglog::count();
        $totalClicks = Clicklog::count();
        
        $recentPhishingLogs = Phishinglog::with('campaign')->latest()->limit(10)->get();
        $recentClickLogs = Clicklog::with('campaign')->latest()->limit(10)->get();
        
        // Campaign performance data
        $campaigns = Campaign::withCount([
            'phishinglogs',
            'clicklogs'
        ])->latest()->limit(5)->get();

        return view('dashboard.index', [
            'totalCampaigns' => $totalCampaigns,
            'activeCampaigns' => $activeCampaigns,
            'totalCredentialsCapture' => $totalCredentialsCapture,
            'totalClicks' => $totalClicks,
            'recentPhishingLogs' => $recentPhishingLogs,
            'recentClickLogs' => $recentClickLogs,
            'campaigns' => $campaigns
        ]);
    }
}
