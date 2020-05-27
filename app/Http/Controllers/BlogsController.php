<?php

namespace App\Http\Controllers;

use App\Blogs;
use Exception;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
     

    /**
     * @return mixed
     */
    public function index()
    {
        $blogs = $this->blogs()->get()->toArray();

        return response()->json([
            'success' => true,
            'data' => $blogs
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $blog = $this->blog()->find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, blogs with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $blog
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'date' => 'required',
            'slug' => 'required',

        ]);

        $blog = new Blogs();
        $blog->id = $request->id;
        $blog->title = $request->title;
        $blog->image = $request->image;
        $blog->description = $request->description;
        $blog->date = $request->date;
        $blog->slug = $request->slug;
       

        if ($this->blogs()->save($blog))
            return response()->json([
                'success' => true,
                'data' => $blog
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, blog could not be added.'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $blog = $this->blog()->find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, blog with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $blog->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $blog
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, blog could not be updated.'
            ], 500);
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    $blog = $this->blog()->find($id);

    if (!$blog) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, blog with id ' . $id . ' cannot be found.'
        ], 400);
    }

    if ($blog->delete()) {
        return response()->json([
            'success' => true
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'blog could not be deleted.'
        ], 500);
    }
}


}
