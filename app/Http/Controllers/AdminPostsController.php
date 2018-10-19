<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$posts = Post::paginate(1);
		return view('admin.posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$user = Auth::user();
		$categories = Category::pluck('name', 'id')->all();
		return view('admin.posts.create', compact('user', 'categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostCreateRequest $request) {
		//return $request->all();
		$input = $request->all();
		$user = Auth::user();
		if ($file = $request->file('photo_id')) {
			$name = $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file_name' => $name]);
			$input['photo_id'] = $photo->id;
		}
		$post1 = $user->posts();
		$post = new Post();
		$post->title = $input['title'];
		$post->body = $input['body'];
		//$post->user_id=$input['user_id'];
		$post->category_id = $input['category_id'];
		$post->photo_id = $input['photo_id'];
		$post1->save($post);
		//dd($input);
		// Post::create([$input]);
		return redirect('/admin/posts');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($slug) {
		$post = Post::where('slug', $slug)->first();
		$user = $post->user()->first();
		$categories = Category::pluck('name', 'id')->all();
		return view('admin.posts.edit', compact('post', 'user', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$post = Post::findOrFail($id);
		$input = $request->all();
		$input['user_id'] = $post->user_id;
		if ($file = $request->file('photo_id')) {
			$name = $file->getClientOriginalName();
			$file->move('images', $name);
			if ($photo = Photo::find($post->photo_id)) {
				$photo_id = $photo->update(['file_name' => $name]);
				$input['photo_id'] = $photo->id;
			} else {
				$photo = Photo::create(['file_name' => $name]);
				$input['photo_id'] = $photo->id;
			}
		}
		$post->update($input);

		return redirect('admin/posts');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		Session::flash('deleted_post', 'User has been deleted successfully');
		$post = Post::findOrFail($id);
		if (file_exists(public_path() . '/images/' . $post->photo->file_name)) {
			unlink(public_path() . '/images/' . $post->photo->file_name);
		}

		$post->delete();
		return redirect('/admin/posts');
	}

	public function post($slug) {
		$post = Post::where('slug', $slug)->first();
		$categories = Category::all();
		$comments = $post->comments;
		return view('post', compact('post', 'categories', 'comments'));
	}
}
