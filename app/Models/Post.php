<?php

namespace Yeayurdev\Models;

use DB;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Post;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Post extends Model
                                    
{

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      	'body',
		'profile_id',
        'image_path',
        'request_streamer',
        'parent_id',
        'user_id',
        'fan_page_id'
    ];

    public function user()
    {
    	return $this->belongsTo('Yeayurdev\Models\User', 'user_id');
    }

    public function likes()
    {
        return $this->morphMany('Yeayurdev\Models\Like', 'likeable');
    }

    public function getImagePath()
    {
        if (!$this->image_path)
        {
            return "";
        }    
            $url = 'https://s3-us-west-2.amazonaws.com/'.env('S3_BUCKET').'/images/posts/';

            return "$url{$this->image_path}";
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany('Yeayurdev\Models\Post', 'parent_id')->orderBy('created_at', 'desc');
    }

    public function votes()
    {
        $upvotes = DB::table('post_vote')->where('post_id', $this->id)->sum('up_vote');

        $downvotes = DB::table('post_vote')->where('post_id', $this->id)->sum('down_vote');

        return $upvotes - $downvotes;
    }
}
