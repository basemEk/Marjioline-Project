<?php

namespace App\Http\Controllers;

use App\Clients;
use Exception;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
     

    /**
     * @return mixed
     */
    public function index()
    {
        $clients = $this->clients()->get()->toArray();

        return response()->json([
            'success' => true,
            'data' => $clients
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $client = $this->client()->find($id);

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, client with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $client
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
            'logo' => 'required',

        ]);

        $client = new Clients();
        $client->id = $request->id;
        $client->name = $request->name;
        $client->logo = $request->logo;
       

        if ($this->clients()->save($client))
            return response()->json([
                'success' => true,
                'data' => $client
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, client could not be added.'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $client= $this->client()->find($id);

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, client with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $client->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $client
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, client could not be updated.'
            ], 500);
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    $client = $this->client()->find($id);

    if (!$client) {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, client with id ' . $id . ' cannot be found.'
        ], 400);
    }

    if ($client->delete()) {
        return response()->json([
            'success' => true
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'client could not be deleted.'
        ], 500);
    }
}


}
