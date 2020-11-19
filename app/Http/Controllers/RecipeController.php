<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Recipe;
use App\Models\Cuisine;
use App\Models\TotalTime;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Quantity;
use App\Models\Measurement;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::get();
        $cuisine_id = Recipe::where('cuisine_id')->get();

        dd($cuisine_id);
        $cuisine_name = Cuisine::where($cuisine_id, 'id');
        
        return view('recipes/index', compact('recipes'));
    }

    public function create()
    {
        $cuisines = Cuisine::get();
        $times = TotalTime::get();
        $ingredients = Ingredient::get();
        $quantities = Quantity::get();
        $measurements = Measurement::get();
        return view('recipes/create', compact('cuisines', 'times', 'ingredients', 'quantities', 'measurements'));
    }
    public function store(Request $request)
    {
        $cuisines = Cuisine::get();
        $times = TotalTime::get();
        $ingredients = Ingredient::get();
        $quantities = Quantity::get();
        $measurements = Measurement::get();

        $name = $request->input('name');
        $description = $request->input('description');
        $image = $request->input('image');
        $video = $request->input('video');
        $source_url = $request->input('source_url');

        $input_cuisine_id = $request->input('cuisine_id');
        $cuisine_id = Cuisine::where('id',[$input_cuisine_id])->value('id');

        $input_time_id = $request->input('total_time_id');
        $time_id = TotalTime::where('id', [$input_time_id])->value('id');

        $recipe = new Recipe;
        $recipe->name = $name;
        $recipe->description = $description;
        $recipe->image_url = $image;
        $recipe->video_url = $video;
        $recipe->cuisine_id = $cuisine_id;
        $recipe->total_time_id = $time_id;
        $recipe->source_url = $source_url;
        $recipe->save();

        foreach($request->input('step') as $i => $step){
        $s = new Step;
        $s->recipe_id = $recipe->id;
        $s->step = $step;
        $s->number = $i + 1;
        $s->save();
        }

        // intermediate table
        


        return view('recipes/create', compact('recipe','cuisines', 'times', 'ingredients'));
    }


}
