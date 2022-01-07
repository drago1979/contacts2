<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['last_name', 'first_name'];

    protected $with = ['phoneNumbers:id,contact_id,description,number'];

    protected $appends = ['delete_url'];


    public function getDeleteUrlAttribute()
    {
        return $this->attributes['delete_url'] = route('contacts.delete', [$this->id]);
    }

    // Relationships
    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }






}
