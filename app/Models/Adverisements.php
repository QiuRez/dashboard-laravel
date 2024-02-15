<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adverisements extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

        protected $fillable = [
        'UserID',
        'CategoryID',
        'Title',
        'Description',
        'AdPhoto',
        'Status',
    ];

    protected $table = 'Adverisements';
    protected $primaryKey = 'AdID';
    public $timestamps = false;
}
