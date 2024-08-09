<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiMovieController extends Controller {
	public function index() {
		return Movie::paginate(10);
	}

	public function store(Request $request) {
		$data = $request->validate([
			'title' => 'required|string|max:255',
			'publish_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
			'poster' => 'nullable|image|max:2048',
		]);

		if ($request->hasFile('poster')) {
			$data['poster'] = $request->file('poster')->store('images', 'public');
		}

		$movie = Movie::create($data);

		return response()->json($movie, 201);
	}

	public function update(Request $request, Movie $movie) {
		$data = $request->validate([
			'title' => 'required|string|max:255',
			'publish_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
			'poster' => 'nullable|image|max:2048',
		]);

		if ($request->hasFile('poster')) {
			if ($movie->poster) {
				Storage::disk('public')->delete($movie->poster);
			}
			$data['poster'] = $request->file('poster')->store('images', 'public');
		}

		$movie->update($data);

		return response()->json($movie);
	}
}
