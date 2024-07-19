<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'joined_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, 'scores');
    }

    public function getHighestScoreAttribute()
    {
        return $this->scores()->max('score');
    }

    public function getAverageScoreAttribute()
    {
        return $this->scores()->avg('score');
    }

    public function getHighestScoreGameAttribute()
    {
        return $this->scores()->orderBy('score', 'desc')->first()->game ?? null;
    }

    public function getMostRecentGameAttribute()
    {
        return $this->games()->latest()->first();
    }
}
