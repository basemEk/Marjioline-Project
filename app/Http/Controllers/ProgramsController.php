<?php

namespace App\Http\Controllers;


use App\Programs;
use Exception;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
     

    /**
     * @return mixed
     */
    public function index()
    {
        $programs = $this->programs()->get()->toArray();

        return response()->json([
            'success' => true,
            'data' => $programs
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $program = $this->user->programs()->find($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, program with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $program
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
            'is_organization' => 'required',
            'slug' => 'required',

        ]);

        $program = new Programs();
        $program->id = $request->id;
        $program->title = $request->title;
        $program->image = $request->image;
        $program->description = $request->description;
        $program->is_organization = $request->is_organization;
        $program->slug = $request->slug;
       

        if ($this->programs()->save($program))
            return response()->json([
                'success' => true,
                'data' => $program
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, program could not be added.'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $program = $this->program()->find($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, program with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $program->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $program
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, program could not be updated.'
            ], 500);
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    $program = $this->program()->find($id);

    if (!$program) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, program with id ' . $id . ' cannot be found.'
        ], 400);
    }

    if ($program->delete()) {
        return response()->json([
            'success' => true
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'program could not be deleted.'
        ], 500);
    }
}


}
