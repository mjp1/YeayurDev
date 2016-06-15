<?php

namespace Yeayurdev\Models;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    use AlgoliaEloquentTrait;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'bio',
        'logo_url',
        'body',
    ];

    public function getDisplayName()
    {
        if ($this->display_name)
        {
            return "{$this->display_name}";
        }
    }

    public function getBio()
    {
        if ($this->bio)
        {
            return "{$this->bio}";
        }
    }

    public function getLogoUrl()
    {
        if ($this->logo_url)
        {
            return "{$this->logo_url}";
        }
    }

    public function followers()
    {
        return $this->belongsToMany('Yeayurdev\Models\User', 'connections', 'fan_page_id', 'user_id');
    }

}
