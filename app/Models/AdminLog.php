<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'AdminID',
        'Action',
        'TargetUserID',
        'TargetAdID'
    ];



    protected $table = 'AdminLog';
    protected $primaryKey = 'LogID';
    public $timestamps = false;
}
