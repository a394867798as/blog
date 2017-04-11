<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleProfile extends Model
{
    protected $table = "article_profile";
    public $timestamps= false;
    protected $fillable = array (
            'apid',
            'aid',
            'acontent',
            'url',
            'create_ip'
    );
}
