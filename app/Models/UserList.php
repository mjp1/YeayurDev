<?php

namespace Yeayurdev;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'userlists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    public function user() 
    {
    	return $this->belongsTo('Yeayurdev\Models\User');
    }
}
