<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phishinglog extends Model
{
    use HasFactory;

    protected $table = 'phishinglogs';

    protected $fillable = [
        'campaign_id',
        'email',
        'password',
        'ip_address',
        'user_agent',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
