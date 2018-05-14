<?php

namespace App\Models;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'nullable', 'subscriber_count'];
}
