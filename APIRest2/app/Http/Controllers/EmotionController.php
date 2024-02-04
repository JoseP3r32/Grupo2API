<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emotion;

class EmotionController extends Controller
{
    public function indexView()
    {
        $emotions = Emotion::all();
        return view('emotions.index', compact('emotions'));
    }
}
