<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inquiry';

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
  protected $fillable = ['is_read', 'is_active', 'is_deleted', 'user_id', 'page', 'first_name', 'last_name', 'email', 'subject', 'message', 'name', 'city', 'state', 'services', 'country'];
    
}
