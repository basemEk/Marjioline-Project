<?php

namespace App\Http\Controllers;

use App\Home;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     

    /**
     * @return mixed
     */
    public function index()
    {
        $home = $this->home()->get()->toArray();

        return response()->json([
            'success' => true,
            'data' => $home
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $home = $this->home()->find($id);

        if (!$home) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, home page ' . $id . ' is not found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $home
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
            'description' => 'required',

        ]);

        $home = new Home();
        $home->id = $request->id;
        $home->description = $request->description;
       

        if ($this->home()->save($home))
            return response()->json([
                'success' => true,
                'data' => $home
            ]);

        // else
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Sorry, home page can not be uploaded.'
        //     ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $home= $this->home()->find($id);

        if (!$home) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, home page ' . $id . ' can not be found.'
            ], 400);
        }

        $updated = $home->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $home
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, home page could not be updated.'
            ], 500);
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    $home = $this->home()->find($id);

    if (!$home) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, home page ' . $id . ' can not be found.'
        ], 400);
    }

    if ($home->delete()) {
        return response()->json([
            'success' => true
        ]);
    }
    
    // else {
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'home page could not be deleted.'
    //     ], 500);
    // }
}


}
