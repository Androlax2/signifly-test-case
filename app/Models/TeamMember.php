<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class TeamMember extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

    /**
     * Rules used to create a new team member.
     *
     * @var string[][]
     */
    public static array $createRules = [
        'first_name' => ['required', 'string', 'max:50'],
        'last_name' => ['required', 'string', 'max:50'],
        'email' => ['required', 'string', 'max:100'],
        'job_title' => ['required', 'string', 'max:100'],
        'location' => ['required', 'string', 'max:100'],
        'phone' => ['required', 'string', 'max:20'],
        'description' => ['nullable', 'string'],
        'photo_path' => ['nullable', 'image|mimes:jpeg,png,jpg,gif|max:2048'],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'slug',
        'email',
        'job_title',
        'location',
        'phone',
        'description',
        'photo_path',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['first_name', 'last_name'],
            ],
        ];
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
     * Get full name of the team member.
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get the storage file path for photo.
     *
     * @param  UploadedFile  $photo
     * @return string
     */
    public function getStoragePhotoPath(UploadedFile $photo): string
    {
        return sprintf('%s/%s.%s', $this->getStorageDir(), $this->generateStorageFileName($photo->getPathname()), $photo->getClientOriginalExtension());
    }

    /**
     * Return all the projects associated with this team member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the storage dir for team members.
     *
     * @return string
     */
    protected function getStorageDir(): string
    {
        return "team-members/{$this->id}";
    }

    /**
     * Generate a filename for the local storage.
     *
     * @param  string  $pathname Path to the file.
     * @return string|false
     */
    protected function generateStorageFileName(string $pathname): string|false
    {
        return sha1_file($pathname);
    }
}
