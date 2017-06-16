<?php
/**
 * Created by PhpStorm.
 * User: zhaoguanglai
 * Date: 2017/6/16
 * Time: 16:20
 */
namespace App\Model;

use App\Article;
use App\ArticleProfile;
use Illuminate\Support\Facades\Redis;

class ArticleModel extends Article{

    /**
     * 对文章列表数据进行处理
     * @param int $limit
     *
     * @return mixed
     */
      public static function getArticleList($limit = 10){
          $articles = Article::orderBy('aid','DESC')->paginate($limit);
          foreach ($articles as $v){
              $article = static::getOneArticleByAid($v->aid);

              $v->content = stripslashes($article->content);
          }

          return $articles;
      }

    /**
     * 获取文章详情
     * @param $aid
     *
     * @return array
     */
      public static function getOneArticleByAid($aid){
          //初始化变量
          $cacheKey = "laravel_article_".$aid;
          $article = Redis::get($cacheKey);
          if(!$article){
              $article = Article::findOrFail($aid);
              if(is_null($article)){
                  abort(404);
              }
              $article->content = ArticleProfile::where('aid',$aid)->value("acontent");
              //设置缓存
              $cacheExpiration  = 86000;
              Redis::set($cacheKey, serialize($article), $cacheExpiration);
          }else{
              $article = unserialize($article);
          }

          return $article;
      }
}