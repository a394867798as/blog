<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleProfile;

class ArticleController extends Controller
{
    /**
     * 列表页
     * @author zhaoguanglai
     * Date: 2017年3月24日
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $articles = Article::orderBy('aid','DESC')->paginate(15)->toArray();
        foreach ($articles['data'] as $k=>$v){
            $articleProfile = ArticleProfile::where('aid','=',$v['aid'])->value("acontent");
            $articles['data'][$k]['content'] = stripslashes($articleProfile);
        }
        return view('articles.index', compact('articles'));
    }
    /**
     * 文章详情页
     * @author zhaoguanglai
     * Date: 2017年3月24日
     * @param int $id
     */
    public function show($id){
        $article = Article::findOrFail($id);
        if(is_null($article)){
            abort(404);
        }
        $article->content = ArticleProfile::where('aid',$id)->value("acontent");
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
}
