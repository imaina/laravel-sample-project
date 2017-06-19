<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

/**
* 
*/
class PostController extends Controller
{
	
	public function getBlogIndex()
	{
		//Fetch posts and paginate
		$posts = Post::paginate(5);

		foreach($posts as $post){
			$post->body = $this->shortenText($post->body, 20);
		}

		return view('frontend.blog.index',['posts' => $posts]);
	}

	public function getPostIndex()
	{
		$posts = Post::paginate(5);

		return view('admin.blog.index', ['posts' => $posts]);
	}

	public function getSinglePost( $end='frontend', $post_id )
	{
		//Fetch the post

		$post = Post::find($post_id);

		if (!$post){

			return redirect()->route('blog.index')->with(['fail' => 'post not found!']);
		}


		return view($end.'.blog.single', ['post' => $post ]);
	}

	public function getCreatePost()
	{
		$categories = Category::all();
		return view('admin.blog.create_post', ['categories' =>$categories]);
	}

	public function postCreatePost(Request $request)
	{
		$this->validate($request, [

			'title'  => 'required|max:120|unique:posts',
			'author' => 'required|max:80',
			'body'   => 'required'
			]);

		$post = new Post();
		$post->title = $request['title'];
		$post->author = $request['author'];
		$post->body = $request['body'];
		$post->save();

		//Attaching categories
		if (strlen($request['categories']) > 0){

			$categoryIDs = explode(',', $request['categories']);
			
			foreach ($categoryIDs as $categoryID)
			{
				$post->categories()->attach($categoryID);
			}
		}


		return redirect()->route('admin.index')->with(['success' => 'Post successfully created!']);

	}
     
    public function getUpdatePost($post_id)
     {
     	$post = Post::find($post_id);
     	$categories = category::all();
     	$post_categories = $post->categories;
     	$post_categories_ids = array();
     	$i = 0;
     	 foreach($post_categories as $post_category){
     	 	$post_categories_ids[$i] = $post_category->id;
     	 	$i++;
     	 }

     	if (!$post){

			return redirect()->route('admin.blog.index')->with(['fail' => 'Post not found!']);
		}
		   //find category

		return view('admin.blog.edit_post', ['post' =>$post, 'categories' =>$categories, 'post_categories' => $post_categories, 'post_categories_ids' =>$post_categories_ids]);

     }

    public function postUpdatePost(Request $request)
     {
         $this->validate($request, [

         	'title'  => 'required|max:120',
			'author' => 'required|max:80',
			'body'   => 'required'
         	]);

         $post = Post::find($request['post_id']);
         $post->title = $request['title'];
		 $post->author = $request['author'];
		 $post->body = $request['body'];
		 $post->update();
		 // categories
		 $post->categories()->detach();

		 	//Attaching categories
		if (strlen($request['categories']) > 0){

			$categoryIDs = explode(',', $request['categories']);

			foreach ($categoryIDs as $categoryID)
			{
				$post->categories()->attach($categoryID);
			}
		}
 
		 return redirect()->route('admin.index')->with(['success' => 'post successfully updated!']);

     }

     public function getDeletePost($post_id)
     {
     	$post = Post::find($post_id);

     	if (!$post){

			return redirect()->route('admin.blog.index')->with(['fail' => 'Post not found!']);
		}

		$post->delete();

		return redirect()->route('admin.index')->with(['success' => 'Post successfully deleted!']);

     }

           

       

	private function shortenText($text, $words_count)
	{
		if (str_word_count($text, 0) > $words_count){
			$words = str_word_count($text, 2);
			$pos = array_keys($words);
			$text = substr($text, 0, $pos[$words_count]) . '...';
		}

		return $text;
	}
}