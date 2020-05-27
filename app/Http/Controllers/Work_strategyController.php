<?php

namespace App\Http\Controllers;


use App\Programs;
use Exception;
use Illuminate\Http\Request;

class Work_strategyController extends Controller
{
     

    /**
     * @return mixed
     */
    public function index()
    {
        $work_strategies = $this->work_strategies()->get()->toArray();

        return response()->json([
            'success' => true,
            'data' => $work_strategies
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $work_strategy = $this->user->work_strategies()->find($id);

        if (!$work_strategy) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, work strategy with id ' . $id . ' can not be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $work_strategy
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
           
        ]);

        $work_strategy = new Work_strategyController();   //why with Controller "Attention Gaby"
        $work_strategy->id = $request->id;
        $work_strategy->title = $request->title;
        $work_strategy->image = $request->image;
        $work_strategy->description = $request->description;
       
       

        if ($this->work_strategies()->save($work_strategy))
            return response()->json([
                'success' => true,
                'data' => $work_strategy
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, work strategy could not be added.'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $work_strategy = $this->program()->find($id);

        if (!$work_strategy) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, work strategy with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $work_strategy->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $work_strategy
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, work strategy could not be updated.'
            ], 500);
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    $work_strategy = $this->work_strategy()->find($id);

    if (!$work_strategy) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, work strategy with id ' . $id . ' cannot be found.'
        ], 400);
    }

    if ($work_strategy->delete()) {
        return response()->json([
            'success' => true
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'work strategy could not be deleted.'
        ], 500);
    }
}


}
