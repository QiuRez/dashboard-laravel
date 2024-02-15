<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function advert() {
        return $this->hasMany(Adverisements::class, 'CategoryID', 'AdID');
    }

    protected $fillable = [
        'CategoryName'
    ];

    protected $table = 'Categories';
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;



}
