<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id'];

    // A team belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // A team has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // A team has many projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
