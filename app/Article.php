<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Input;
use File;
use Image;



class Article extends Model
{

    private $resizeTo = 425;

    protected $fillable = [
        'user_id','title', 'body', 'published_at', 'excerpt', 'image','thumbnail'
    ];
    protected $table = 'articles';
    protected $dates = ['published_at'];

    /**
     *  an article has one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    // get comments associated with article
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        $query->where('published_at', '=>', Carbon::now());
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
        //$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
     * get a list of tag ids associated with the current article
     *
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }

    /**
     * @param $id
     */
    public function setUserIdAttribute($id)
    {
        $this->attributes['user_id'] = $id;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        if(!empty($this->image) && File::exists($this->image))
        {

            // Get the filename from the full path
            $filename = basename($this->image);

            return 'images/'.$filename;
        }

        return 'images/missing.png';
    }

    /**
     * @return string
     */
    public function getThumbnail()
    {
        if(!empty($this->thumbnail) && File::exists($this->thumbnail))
        {

            // Get the filename from the full path
            $filename = basename($this->thumbnail);

            return 'images/thumbnails/'.$filename;
        }

        return 'images/missing.png';
    }

    /**
     * @param $image
     * @return mixed
     */
    public function resize($image)
    {
        $resize = Image::make($image);
        $resize->resize($this->resizeTo, null, function ( $constraint )
        {
            $constraint->aspectRatio();
        });

        return $resize;
    }

    /**
     * Handle the uploaded file, rename the file, move the file, return the filepath as a string
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function storeImage($request)
    {
        $destinationPath = 'images'; // upload path, goes to the public folder

        $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
        $fileName = substr(microtime(), 2, 8).'_uploaded.'.$extension; // renaming image

        $request->file('image')->move($destinationPath, $fileName); // uploading file to given path

        $fullPath = $destinationPath."/".$fileName; // set the image field to the full path

        return $fullPath;

    }

    /**
     * Using the uploaded file, create a thumbnail and save it into the thumbnail folder
     *
     * @param $request
     * @return string
     */
    public function storeThumbnail($request)
    {
        $thumbDestination = 'images/thumbnails';

        $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
        $fileThumbnailName = substr(microtime(), 2, 8).'_uploaded_thumb.'.$extension;

        $thumbnail = $this->resize($this->getImage());

        $fullPath = $thumbDestination."/".$fileThumbnailName;

        $thumbnail->save($fullPath);

        return $fullPath;
    }

    /**
     * Using storeImage(), assign this articles' image attr to the path returned
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function setImage($request)
    {
        $this->image = $this->storeImage($request);
    }

    /**
     *  using storeThumbnail(), also assign this article's thumbnail attribute the path returned
     * @param $request
     */
    public function setThumbnail($request)
    {
        $this->thumbnail = $this->storeThumbnail($request);
    }

    /**
     *  Deletes articles' image files
     *
     */
    public function deleteImages()
    {
        $path = public_path();

        if(File::delete($path.'/'.$this->image) && File::delete($path.'/'.$this->thumbnail))
        {
            return true;
        }
        return false;

    }

    public function updateImage($request)
    {
        if( $request->file('image') !== null ) {  /// check if an image is attached
            if($this->deleteImages()) {
                $this->setImage($request); // update the image
                $this->setThumbnail($request); // update the thumbnail
                $this->update(); // set the image update
                return ', and files updated successfully.';
            } else {
                return ', but files deletion failed.';
            }
            return ', and the image is unchanged.';
        }
    }
}