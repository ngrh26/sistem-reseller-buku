<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'join_date',
        'total_purchase',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'join_date' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}