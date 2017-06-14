<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleProfile;
use App\Events\SomeEvent;
use \Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
class ArticleController extends Controller
{
    /**
     * 列表页
     * @author zhaoguanglai
     * Date: 2017年3月24日
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $articles = Article::orderBy('aid','DESC')->paginate(15);
        foreach ($articles as $v){
            $articleProfile = ArticleProfile::where('aid','=',$v->aid)->value("acontent");
            $v->content = stripslashes($articleProfile);
        }
        return view('articles.index', compact('articles'));
    }
    /**
     * 文章详情页
     * @author zhaoguanglai
     * Date: 2017年3月24日
     * @param int $id
     */
    public function show(Request $request,$id){
        //初始化变量
        $cacheKey = "laravel_article_".$id;
        $article = Redis::get($cacheKey);
        if(!$article){
            $article = Article::findOrFail($id);
            if(is_null($article)){
                abort(404);
            }
            $article->content = ArticleProfile::where('aid',$id)->value("acontent");
            //设置缓存
            $cacheExtime = 86000;
            Redis::set($cacheKey, serialize($article), $cacheExtime);
        }else{
            $article = unserialize($article);
        }
        //加入事件监听
        event(new SomeEvent($article));
        $title = $article->atitle;
        return view('articles.show', compact('article','title'));
    }
    /**
     * 创建文章
     * @author zhaoguanglai
     * Date: 2017年4月7日
     */
    public function create(){
        return view('articles.create');
    }
    /**
     * 执行添加文章
     * @author zhaoguanglai
     * Date: 2017年4月7日
     */
    public function store(StoreArticleRequest $request){
        //初始化变量
        $nowTime = strtotime($request->get("published_at"));
        $article = new Article();
        $article->atitle = $request->get('title');
        $article->type = 1;
        $article->status = 2;
        $article->create_uid = $article->modify_uid =  14827;
        $article->update_time = $article->modify_time = $article->create_time = $nowTime;
        //执行添加文章
        $article->save();
        if($article->aid){
            $articleProData['aid'] = $article->aid;
            $articleProData['acontent'] = $request->get('content');
            $articleProData['create_ip'] = ip2long($request->getClientIp());
            ArticleProfile::insert($articleProData);
        }
        return redirect('/article');
    }

    public function test(){
        $article = Article::limit(10)->get();
//        foreach ($article as $v){
//            echo $v->atitle."<br/>";
//        }
        echo $article->max('aid');
    }
}
