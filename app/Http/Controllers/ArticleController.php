<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleProfile;
use App\Events\SomeEvent;
use App\Model\ArticleModel;
use \Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
class ArticleController extends Controller
{
    /**
     * 列表页
     * @author zhaoguanglai
     * Date: 2017年3月24日
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $articles = ArticleModel::getArticleList(15);

        return view('articles.index', compact('articles'));
    }
    /**
     * 文章详情页
     * @author zhaoguanglai
     * Date: 2017年3月24日
     * @param int $id
     */
    public function show(Request $request,$id){
        //获取详情
        $article = ArticleModel::getOneArticleByAid($id);
        //加入事件监听
        event(new SomeEvent($article));
        config('app.name', $article->atitle) ;
        return view('articles.show', compact('article'));
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
