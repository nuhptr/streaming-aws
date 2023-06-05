<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    // Main page of movies
    public function index()
    {
        $movies = Movie::all();

        return view('admin.movies', ['movies' => $movies]);
    }

    // Create page of movies
    public function create()
    {
        return view('admin.movie-create');
    }

    // go to edit page of movies
    public function edit($id)
    {
        $movie = Movie::find($id);

        return view('admin.movie-edit', ['movie' => $movie]);
    }

    // store movie
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'title' => 'required|string',
            'small_thumbnail' => 'required|image|mimes:jpeg,jpg,png',
            'large_thumbnail' => 'required|image|mimes:jpeg,jpg,png',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required'
        ]);

        $smallThumbnail = $request->small_thumbnail;
        $largeThumbnail = $request->large_thumbnail;

        $originalSmallThumbnail = Str::random(10) . $smallThumbnail->getClientOriginalName();
        $originalLargeThumbnail = Str::random(10) . $largeThumbnail->getClientOriginalName();

        $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnail);
        $smallThumbnail->storeAs('public/thumbnail', $originalLargeThumbnail);

        $data['small_thumbnail'] = $originalSmallThumbnail;
        $data['large_thumbnail'] = $originalLargeThumbnail;

        // dd($data);

        Movie::create($data);

        return redirect()->route('admin.movie')->with('success', 'Movie created successfully');
    }

    // update movie
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'title' => 'required|string',
            'small_thumbnail' => 'image|mimes:jpeg,jpg,png',
            'large_thumbnail' => 'image|mimes:jpeg,jpg,png',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required'
        ]);

        $movie = Movie::find($id);

        if ($request->small_thumbnail) {
            //? save new image
            $smallThumbnail = $request->small_thumbnail;
            $originalSmallThumbnail = Str::random(10) . $smallThumbnail->getClientOriginalName();
            $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnail);
            $data['small_thumbnail'] = $originalSmallThumbnail;

            //? delete old image
            Storage::delete('public/thumbnail/' . $movie->small_thumbnail);
        }

        if ($request->large_thumbnail) {
            //? save new image
            $largeThumbnail = $request->large_thumbnail;
            $originalLargeThumbnail = Str::random(10) . $largeThumbnail->getClientOriginalName();
            $smallThumbnail->storeAs('public/thumbnail', $originalLargeThumbnail);
            $data['large_thumbnail'] = $originalLargeThumbnail;

            //? delete old image
            Storage::delete('public/thumbnail/' . $movie->large_thumbnail);
        }

        $movie->update($data);

        return redirect()->route('admin.movie')->with('success', 'Movie updated');
    }

    // soft delete movie
    public function destroy($id)
    {
        Movie::find($id)->delete();

        return redirect()->route('admin.movie')->with('success', 'Movie deleted');
    }
}
