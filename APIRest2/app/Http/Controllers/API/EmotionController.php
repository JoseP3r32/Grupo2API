<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Emotion;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EmotionResource;
use Illuminate\Http\JsonResponse;

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
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

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
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $emotion->name = $input['name'];
        $emotion->description = $input['description'];
        $emotion->save();

        return $this->sendResponse(new EmotionResource($emotion), 'Emotion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Emotion $emotion): JsonResponse
    {
        $emotion->delete();

        return $this->sendResponse([], 'Emotion deleted successfully.');
    }
}

