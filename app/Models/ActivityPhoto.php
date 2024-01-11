<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPhoto extends Model
{
    use HasFactory;

    protected $table = 'activity_photos';

    protected $fillable = [
        'activity_id', 'path',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'item_id');
    }
}
