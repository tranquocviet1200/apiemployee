<?php

namespace App\Modules\Employee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Employee extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'employees';
    
    protected $fillable = [
        'name',
        'email',
        'position',
        'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
