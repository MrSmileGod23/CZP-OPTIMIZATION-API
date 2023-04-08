<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'PassNumber',
        'CarNumber',
        'FIO',
        'SenderName',
        'CheckpointNumber',
        'ProductType',
        'ProductVolume',
        'MetricUnit',
        'status',
        'queue',
        'point'
    ];
}
