<?php

class Gallery extends \Eloquent {
	
	public static function valid($id='') {
		return array(
			'title' => 'required',
			'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:200',
			'user' =>  'required'
		);
	}
	
	
}