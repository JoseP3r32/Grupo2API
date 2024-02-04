<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Emotion;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EmotionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class EmotionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $emotions = Emotion::all();

        return $this->sendResponse(EmotionResource::collection($emotions), 'Emotions retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'image' => 'required',
            // No es necesario validar 'user_id' ya que podemos obtenerlo del usuario autenticado
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
    
        $input = $request->all();
        // Obtenemos el ID del usuario autenticado
        $input['user_id'] = Auth::id();
        $emotion = Emotion::create($input);
    
        return $this->sendResponse(new EmotionResource($emotion), 'Emotion created successfully.');
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $emotion = Emotion::find($id);

        if (is_null($emotion)) {
            return $this->sendError('Emotion not found.');
        }

        return $this->sendResponse(new EmotionResource($emotion), 'Emotion retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emotion $emotion): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'image' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $emotion->update($request->all());

        return $this->sendResponse(new EmotionResource($emotion), 'Emotion updated successfully.');
    }


    public function destroy($id): JsonResponse
    {
        $emotion = Emotion::find($id);

        if (is_null($emotion)) {
        return $this->sendError('Emotion not found.');
        }

        $emotion->delete();

        return $this->sendResponse([], 'Emotion deleted successfully.');
    }

}
