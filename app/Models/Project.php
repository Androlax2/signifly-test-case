<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Rules used to create a new project.
     *
     * @var string[][]
     */
    public static array $createRules = [
        'description' => ['required', 'string'],
        'slug'        => ['required', 'string', 'max:100'],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'description',
    ];

    /**
     * Get URL for a project.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return route('projects.show', $this);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Retrieve all the team members associated with this project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teamMembers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TeamMember::class);
    }
}
