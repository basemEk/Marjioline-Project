<?php

namespace App\Http\Controllers;

use App\Testimonials;
use Exception;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
     

    /**
     * @return mixed
     */
    public function index()
    {
        $testimonials = $this->testimonials()->get()->toArray();

        return response()->json([
            'success' => true,
            'data' => $testimonials
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $testimonial = $this->testimonial()->find($id);

        if (!$testimonial) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, testimonial with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $testimonial
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
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',

        ]);

        $testimonial = new Testimonials();
        $testimonial->id = $request->id;
        $testimonial->name = $request->name;
        $testimonial->image = $request->image;
        $testimonial->description = $request->description;

       

        if ($this->testimonials()->save($testimonial))
            return response()->json([
                'success' => true,
                'data' => $testimonial
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, testimonial could not be added.'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $testimonial = $this->testimonial()->find($id);

        if (!$testimonial) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, testimonial with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $testimonial->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $testimonial
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, testimonial could not be updated.'
            ], 500);
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    $testimonial = $this->testimonial()->find($id);

    if (!$testimonial) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, testimonial with id ' . $id . ' cannot be found.'
        ], 400);
    }

    if ($testimonial->delete()) {
        return response()->json([
            'success' => true
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'testimonial could not be deleted.'
        ], 500);
    }
}


}
