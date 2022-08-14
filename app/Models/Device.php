<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $casts = ['id' => 'string','is_new' => 'boolean'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'model',
        'brand',
        'release_date',
        'os',
        'is_new',
        'received_datatime',
        'created_datetime',
        'update_datetime'
    ];
    public function scopeSearch($query, $search){
        if($search)
            return $query->where('brand', 'like', '%' . $search . '%')
            ->orWhere('model', 'like', '%' . $search . '%')
            ->orWhere('os', 'like', '%' . $search . '%')
            ->orWhere('release_date', 'like', '%' . $search . '%');
    }
}
