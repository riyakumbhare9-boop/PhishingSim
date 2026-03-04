<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clicklog extends Model
{
    use HasFactory;

    protected $table = 'clicklogs';

    protected $fillable = [
        'campaign_id',
        'visitor_ip',
        'user_agent',
        'referer',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
