<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'image', 'name', 'phone', 'division_id', 'position'
    ];

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Uuid::uuid4()->toString();
            }
        });
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
