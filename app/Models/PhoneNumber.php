<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'number'];

    protected $appends = ['delete_url'];

    public function getDeleteUrlAttribute()
    {
        return $this->attributes['delete_url'] = route('phone_numbers.delete', [$this->contact_id, $this->id]);
    }

}
