<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitees extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invitees';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email'];

    
    public static function findOrCreate($search)   {
        $invitee = Invitees::find($search);
        return $invitee ?: new Invitees;
    }
}
