<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    //
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    /* Mutators:
    Are functions that mutates or changes a value before it reaches the database
    Follows a naming convension, the words from the function name, 'set' and 'attribute' are set for mutators while 'PostImage' is coming from column name post_image

   public function setPostImageAttribute($value){

       $this->attributes['post_image'] = asset($value);

    }
*/
    /* accessor returns data and does not edit value before going into db but the naming conversion only 'get' is replaced by 'set'

    */
    public function getPostImageAttribute($value){
        if(Str::contains($value, "http"))
            return asset($value);
        else
            return asset("storage/".$value);

    }
}
