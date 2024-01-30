<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['name', 'description', 'date', 'image', 'deleted', 'user_id'];
    public $timestamps = true;
    protected $table = 'emotions';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
