<?php

class ArticlesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct() {
	    $this->beforeFilter('auth');
	}
	public function index()
	{
	    $articles = Article::paginate(10);
            return View::make('articles.index')
	   		->with('articles', $articles);
	
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    return View::make('articles.create');
	}
	
	
	public function export($id)
	{
	   
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');
	    $article = Article::find($id);
	    
	    Excel::create('filename', function($excel) use($comments,$article)
	    {
		$excel->sheet('article', function($sheet) use($article,$comments){

			$sheet->setSize('C2',300,200);
			$sheet->getStyle('C2')->getAlignment()->setWrapText(true);

            $sheet->row(1, array('Title','Content','Author'));
		    $sheet->row(2, array($article->title,$article->content,$article->author));
		    
		});
		
		$excel->sheet('comments', function($sheet) use($comments){
		    $sheet->row(1, array('Comment','User'));
		    $sheet->setAutoSize(true);
		    $count=2;
		    foreach($comments as $list){
						
			$sheet->row($count,array($list->content,$list->user));
			$count += 1;
    		    }
		});
		
	    })->download('xls');
	}
	
	
	public function import()
	{
	    return View::make('articles.import');
	}
	
	public function getimport()
	{
	    $path_file ='public/file_excel/' ;
	    $file = Input::file('import_file');
            $filename = $file->getClientOriginalName();
            Input::file('import_file')->move($path_file, $filename);
	    Excel::load($path_file.'/'.$filename, function($reader)
	    {
	    	$results = $reader->all(array('title','content','author','comment','user'));
	    	
	    	$data = count($results[0]);
	    	$count_comment = count($results[1]);

	    	for($a=0;$a<$data;$a++){
	    		
			    $title 		= $results[0][$a]['title'];
			    $content	= $results[0][$a]['content'];
			    $author 	= $results[0][$a]['author'];

			     
			    $article 			= new Article;
			    $article->title 	= $title;
			    $article->content 	= $content;
			    $article->author 	= $author;
			    
					    
			    $article->save();
			    

	    	}
	    	    	
	    	for($x=0;$x<$count_comment;$x++){

			 	
			 	$article_id			= $article->id;
			 	$comment_article 	= $results[1][$x]['comment'];
			 	$user 				= $results[1][$x]['user'];
			 	
			 	
			 	$comment 				= new Comment();
			 	$comment->article_id 	= $article_id;
			 	$comment->content 		= $comment_article;
			 	$comment->user 			= $user;

			 	$comment->save();
		 	}
		});
	    Session::flash('notice','Success import article');
            return Redirect::to('articles');
	}
	
	
	public function export_to_pdf($id)
	{
	   
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');
	    $article = Article::find($id);
	    
	    Excel::create('filename', function($excel) use($comments,$article)
	    {
		$excel->sheet('article', function($sheet) use($article,$comments){

			$sheet->mergeCells('A3:C3');
			$sheet->setSize('C2',50);
			$sheet->getStyle('C2')->getAlignment()->setWrapText(true);

            $sheet->row(1, array('ID', 'Title','Content'));
		    $sheet->row(2, array($article->id,$article->title,$article->content));

		    $sheet->row(4,array('Article','User','Comment'));
		    $count = 5;
		    foreach ($comments as $list) {
		    	$sheet->row($count,array($list->article_id,$list->user,$list->content));
		    	$count += 1;
		    }
		    
		});
		})->export('pdf');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $validate = Validator::make(Input::all(), Article::valid());
            if($validate->fails()){
                return Redirect::to('articles/create')->withErrors($validate)->withInput();
            }else{
                $article = new Article;
                $article->title = Input :: get('title');
                $article->content = Input::get('content');
                $article->author = Input::get('author');
                $article->save();
                Session::flash('notice','Success add article');
                return Redirect::to('articles');
                
            }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $article = Article::find($id);
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');
	    return View::make('articles.show')
	    ->with('article', $article)
	    ->with('comments', $comments);
	}
	
	


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    $article = Article::find($id);
            return View::make('articles.edit')->with('article', $article);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            $validate = Validator::make(Input::all(), Article::valid($id));
            if($validate->fails()){
                return Redirect::to('articles/'.$id.'/edit')->withErrors($validate)->withInput();
            }else{
                $article = Article::find($id);
                $article->title = Input::get('title');
                $article->content = Input::get('content');
                $article->author = Input::get('author');
                $article->save();
                Session::flash('notice', 'Success update article');
                return Redirect::to('articles');
            }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    $article = Article::find($id);
            $article->delete();
            Session::flash('notice','Article success delete');
            return Redirect::to('articles');
	}


}
