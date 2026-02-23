<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    //
protected $fillable = [
        'name',
        'class',
        'user_id'
    ];

public function user()
{
    // longs to main
    return $this->belongsTo(User::class);
}

}

