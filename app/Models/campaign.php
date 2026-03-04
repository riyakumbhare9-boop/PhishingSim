<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'email_body',
        'phishing_link',
        'status',
        'target_emails',
    ];

    public function phishinglogs()
    {
        return $this->hasMany(Phishinglog::class);
    }

    public function clicklogs()
    {
        return $this->hasMany(Clicklog::class);
    }

    public function getTargetEmailsArray()
    {
        if (!$this->target_emails) {
            return [];
        }
        return array_filter(array_map('trim', explode("\n", $this->target_emails)));
    }
}
