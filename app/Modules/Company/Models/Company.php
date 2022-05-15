<?php

namespace App\Modules\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Company extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',];
    
    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }
}
