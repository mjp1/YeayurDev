<?php

namespace Yeayurdev\Models;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    use AlgoliaEloquentTrait;

    /* Create environment-specific index */
    public static $perEnvironment = true;

    /* Create custom Algolia index */
    public $indices = ['profilesAndFans'];
    
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

    public function getAlgoliaRecord()
    {
        return array_merge($this->toArray(), [
            'username' => $this->display_name,
            'image_path' => $this->logo_url,
            'about_me' => $this->bio,
            'followers_count' => $this->followers_count
        ]);
    }

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
