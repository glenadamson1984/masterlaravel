<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Comment extends Model
{
    use HasFactory;

    // IMPORTANT - NAMING CONVENTION
    // the naming of this method is very important as it aids laravel in finding the correct foreign key
    // our foreign key is blog_post_id so laravel looks at snake case and knows to seperate them with the _
    // so blogPost becomes blog_post and then it appends the field we need so blog_post_id
    // if we renamed this method to lets say post then laravel would look for post_id and would run into issues as
    // this does not exist

    //however if your table was named blog_post but you wanted the foreign key to be post_id there is additional
    //parameters you can pass to the belongs to method to do this - best looking at docus
    //but we could do this return $this->belongsTo(BlogPost::class, 'post_id);
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
