<?php

namespace App\Http\Controllers\Home;

use App\Models\Posts;
use App\Models\Categories;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
	public function index($tag)
	{
		// Cari semua artikel yang memiliki tag yang sama dengan $tag
		$posts = Posts::with(['user', 'comments', 'category'])->where('active', 1)->where('tags', 'LIKE', "%$tag%")->paginate(4);

		if ($posts->isEmpty()) {
			abort(404);
		}

		$categories = Categories::withCount(['posts' => function ($query) {
			$query->where('active', 1);
		}])->get();

		$selectedTag = $tag;

		$tags = Posts::where('active', 1)->pluck('tags')->flatMap(function ($tags) {
			return explode(',', $tags);
		})->unique()->reject(function ($tag) {
			return empty($tag); // Hapus tag yang kosong
		});

		return view('tags', compact('posts', 'tags', 'categories', 'selectedTag'));
	}
}