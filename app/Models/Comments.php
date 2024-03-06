<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class, 'AuthorUserID', 'UserID');
    }
    public function target()
    {
        return $this->belongsTo(User::class, 'TargetUserID', 'UserID');
    }

    protected $fillable = [
        'AuthorUserID',
        'TargetUserID',
        'TargetAdID',
        'Description',
    ];
    protected $table = 'Comments';

}
