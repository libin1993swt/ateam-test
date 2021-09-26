<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteesEvents extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invitees_events';

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
    protected $fillable = ['event_id', 'invitees_id'];

}
