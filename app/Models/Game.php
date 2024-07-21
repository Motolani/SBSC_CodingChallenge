<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
	    'name','game_admin_id','player_count','date','status'
	];


    public function scores()
    {
        return $this->hasMany(Score::class, 'game_id');
    }


}
