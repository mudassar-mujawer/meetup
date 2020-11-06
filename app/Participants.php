<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'participants';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name', 'age', 'DOB', 'profession', 'locality', 'number_of_guests', 'address'];
}
