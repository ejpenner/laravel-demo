<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['body','user_id','article_id'];
    protected $dates = ['published_at'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function article()
    {
        return $this->belongsTo('App\Article');
    }


    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function setPublishedAtToNow()
    {
        $this->attributes['published_at'] = Carbon::now();
    }

    public function setUserIdAttribute()
    {
        $this->attributes['user_id'] = Auth::user()->id;
    }

    /**
     * returns string
     */
    public function getUsername()
    {
        return User::whereId($this->user_id)->pluck('name');
    }

}
