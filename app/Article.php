<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //表名
    protected $table = "article";
    protected $primaryKey = "aid";
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'aid',
			'atitle',
			'type',
			'status',
			'visit_num',
	        'real_views',
			'support_num_unreg',
			'support_num',
			'keyword_id1',
			'keyword_id2',
			'keyword_id3',
			'create_uid',
			'create_type',
			'create_name',
			'create_time',
	        'is_reported',
			'verify_uid',
			'verify_time',
            'verify_reason',
			'modify_uid',
			'modify_time',
			'is_del',
			'update_time'
    ];
    
    
}
