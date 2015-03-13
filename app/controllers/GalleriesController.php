<?php

class GalleriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $galleries = Gallery::paginate(10);
            return View::make('galleries.index')
	   ->with('galleries', $galleries);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    return View::make('galleries.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

            $validate = Validator::make(Input::all(), Gallery::valid());
            if($validate->fails()){
                return Redirect::to('galleries/create')->withErrors($validate)->withInput();
            }else{
                
                $gallery = new Gallery;
                $gallery->title = Input::get('title');
                $gallery->user = Input::get('user');
                
                $image = Input::file('image');
                $filename = $image->getClientOriginalName();
                $gallery->image = $filename;
                
               
                $gallery->save();
                
                $findId = Gallery::where('image','=',$filename)->first();
                
                
                
                $path = public_path().'/upload_gambar/'.$findId->id;
                File::makeDirectory($path, $mode=0777,true,true);
                
               
                $name_thumb = 'thumb-'.$image->getClientOriginalName();
                $name_image = 'image-'.$image->getClientOriginalName();
                Image::make($image)->resize(200,100)->save($path.'/'.$name_thumb);
                $image->move($path, $name_image);
                
                
                Session::flash('notice','Image Success Uploaded');
                return Redirect::to('galleries');
                
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
	    $gallery = Gallery::find($id);
            return View::make('galleries.show')
	    ->with('gallery', $gallery);
	    
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    $gallery = Gallery::find($id);
            return View::make('galleries.edit')->with('gallery', $gallery);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    //$validate = Validator::make(Input::all(), Gallery::valid($id));
            //if($validate->fails()){
              //  return Redirect::to('galleries/'.$id.'/edit')->withErrors($validate)->withInput();
            //}else{
                if(Input::file('image')){
		    $gallery = Gallery::find($id);
		    $gallery->title = Input::get('title');
		    $gallery->user = Input::get('user');
		    $name = $gallery->image; 
                    
		    $image = Input::file('image');
		    $filename = $image->getClientOriginalName();
		    $gallery->image = $filename;
		    
		    
		    $path = public_path().'/upload_gambar/'.$gallery->id;
		                    
		    $name_thumb = 'thumb-'.$image->getClientOriginalName();
		    $name_image = 'image-'.$image->getClientOriginalName();
		    
		    $name_thumb_delete = 'thumb-'.$name;
		    $name_image_delete = 'image-'.$name;
		    
		    File::delete($path.'/'.$name_thumb_delete,$path.'/'.$name_image_delete);
		    
		    Image::make($image)->resize(200,100)->save($path.'/'.$name_thumb);
		    $image->move($path, $name_image);
                    $gallery->save();
		    Session::flash('notice', 'Success update image');
                    return Redirect::to('galleries');
              
                    
                }else{
		    $gallery = Gallery::find($id);
		    $gallery->title = Input::get('title');
		    $gallery->user = Input::get('user');
		    $gallery->save();
                    Session::flash('notice', 'Success update with out image');
                    return Redirect::to('galleries');
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
	    $gallery = Gallery::find($id);
            //File::delete('public/upload_gambar/'.$gallery->image);
            $path = public_path().'/upload_gambar/'.$gallery->id;
            File::deleteDirectory($path);
            $gallery->delete();
            Session::flash('notice','Image success delete');
            return Redirect::to('galleries');
	}


}
