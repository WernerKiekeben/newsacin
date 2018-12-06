<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\News;
use Auth;
use DB;

class NewsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHome()
    {
        return view('auth.login');
    }

    public function storeNews(Request $request)
    {
        // Validation to submit new News
        $this->validate($request,[
            'title' => 'required',
            'state' => 'required',
            'body' => 'required'
        ]);

        // Create News
        $post = new News;
        $post->title = strip_tags($request->input('title'));
        $post->content = ($request->input('body'));
        $post->publication = \Carbon\Carbon::now();
        $post->idUser = Auth::id();
        $post->idState = $request->input('state');
        $post->save();

        return redirect('news')->with('success', 'News created');
    }

    public function getNews()
    {
        $news = DB::table('news')
                    ->join('state', 'news.idState' ,'=', 'state.id')
                    ->select('news.*', 'state.description')
                    ->orderBy('created_at', 'desc')
                    ->paginate(8);

        return view('pages.news')->with('result', $news);
    }

    public function newsAjax(){
        $news = DB::table('news')
                    ->join('state', 'news.idState' ,'=', 'state.id')
                    ->select('news.*', 'state.description')
                    ->orderBy('created_at', 'desc')
                    ->paginate(8);

        return view('inc.table')->with('result', $news);
    }

    public function getCreate()
    {
        return view('pages.create');
    }

    public function editNews($id)
    {
        $new = News::find($id);

        // Check for correct user
        if(Auth::id() !== $new->idUser && Auth::user()->name !== 'Admin'){
            return redirect('/news')->with('error', 'Unauthorized Access');
        }

        return view('pages.edit')->with('new', $new);
    }

    public function updateNews(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'state' => 'required'
         ]);

         $new = NEWS::find($id);
         $new->title = strip_tags($request->input('title'));
         $new->content = ($request->input('body'));
         $new->idState = strip_tags($request->input('state'));
         $new->save();
 
         return redirect('news')->with('success', 'News Updated');
    }

    public function showNews($id)
    {
        $show = DB::table('news')
                    ->join('users', 'news.idUser', '=', 'users.id')
                    ->select('news.*', 'users.name')
                    ->where('news.id', $id)
                    ->get();

        return view('pages.show')->with('new', $show);
    }

    public function searchNews(Request $request)
    {
        $title = strip_tags($request->title);
        $date = '0001-01-01';
        if($request->date){
            $date = $request->date;
        }
        $state = $request->state;

        $result = News::where([
            ['title','LIKE','%'.$title.'%'],
            ['publication','>=', $date],
            ['idState','=',$state],
        ])->join('state', 'news.idState' ,'=', 'state.id')
        ->select('news.*', 'state.description')
        ->latest()
        ->paginate(8);

        return view('inc.table')->with('result',$result);
    }

    public function destroy($id) // Destroys news through id
    {
        $new = News::find($id);

        // Check for correct user
        if(Auth::id() !== $new->idUser && Auth::user()->name !== 'Admin'){
            return redirect('/news')->with('error', 'Unauthorized Access');
        }

        $new->delete();

        return redirect('news')->with('success', 'News Removed');
    }

    public function deleteUser($id)
    {
        $user = Auth::user($id);

        $user->delete();

        return redirect('home');
    }
}