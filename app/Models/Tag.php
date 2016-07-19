<?php

namespace Yeayurdev\Models;

use Yeayurdev\Models\User;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_name',
    ];

    public function users()
    {
        return $this->belongsToMany('Yeayurdev\Models\User', 'user_tags', 'tag_id', 'user_id');
    }
}
