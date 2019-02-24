<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Illustration;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        return view('posts.index', compact('posts'));
    }




    /**
     * Searching resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%'.$request->title.'%')->paginate(10);
        $posts->appends(['title' => $request->title]);
        $word = $request->title;
        return view('posts.search', compact('posts', 'word'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);

        $post = Post::create([
          'title'   => $request->title,
          'content' => $request->content,
        ]);

        // Store illustration file
        $filename = $post->id.'.'.strtolower($request->illustration->extension());
        $request->illustration->storeAs('public', $filename);

        $illustration = Illustration::create([
          'filename'  => $filename,
          'post_id'   => $post->id,
        ]);

        if ($post && $illustration)
        {
          return redirect()->route('index');
        }
        else {
          return redirect()->back()->withErrors([
            'errors' => 'Erreur lors de l\'enregistrement !',
          ]);
        }
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Post::$rulesUpdate);

        $post = Post::findOrFail($id);

      // if update illustration ////////////
        if ($request->illustration)
        {
          $illustration = Illustration::where('post_id', $id)->first();
        // if illustration post_id founded
          if ($illustration)
          {
            $this->validate($request, Illustration::$rulesUpdate);

            $filename = public_path('/storage/'.$post->illustration->filename);

            // If file exists (Delete and reupload to replace)
            if (File::exists($filename))
            {
              File::delete($filename);
            }

            $filename = $id.'.'.strtolower($request->illustration->extension());
            $request->illustration->storeAs('public', $filename);

            $illustration->update([
              'filename'  => $filename,
            ]);
          }
        }
      //////////////////////////////////////

        $post->update([
          'title'   => $request->title,
          'content' => $request->content,
        ]);

        return redirect()->route('posts.edit', $id);
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $filename = public_path('/storage/'.$post->illustration->filename);

        // Delete associate illustration if exists
        if (File::exists($filename))
        {
          File::delete($filename);
        }

        if ($post->delete())
        {
          return redirect()->route('index');
        }
        else
        {
          return redirect()->back();
        }


    }
}
