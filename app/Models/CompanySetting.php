<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [

'company_name',

'email',

'phone',

'website',

'address',

'logo',

'footer_text',

];
}
