<?php

namespace App\Http\Controllers;


use App\About;
use Exception;
use Illuminate\Http\Request;

class AboutController extends Controller
{
     

    /**
     * @return mixed
     */
    public function index()
    {
        $about = About::all()->toArray();

        return response()->json([
            'success' => true,
            'data' => $about
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, about page with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $about
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
            'image' => 'required',
            'description' => 'required',

        ]);

        $about = new About();
        $about->id = $request->id;
        // TODO: Search how to upload images to Laravel, check Laraval Storage
        $about->image = $request->image;
        $about->description = $request->description;

       

        if ($this->about()->save($about))
            return response()->json([
                'success' => true,
                'data' => $about
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, about page could not be loaded.'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, about page ' . $id . ' cannot be found.'
            ], 400);
        }

        // TODO: Search how to upload images to Laravel, check Laraval Storage
        // TODO: How to update image
        $updated = $about->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $about
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, about page could not be uploaded.'
            ], 500);
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    $about = $this->about()->find($id);

    if (!$about) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, about page ' . $id . ' can not be found.'
        ], 400);
    }

    if ($about->delete()) {
        return response()->json([
            'success' => true
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'you could not delete contents from about page.'
        ], 500);
    }
}


}
