<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHeroRequest;
use App\Http\Requests\UpdateHeroRequest;
use App\Http\Resources\SuperHeroResource;
use App\Models\SuperHero;
use Illuminate\Http\Request;


class SuperHeroController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateHeroRequest $request)
    {
        try {

            SuperHero::create($request->validated());

            return response()->json("SuperHero Created");

        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Something went wrong in SuperHeroController.create',
                'error' => $err->getMessage()
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function showAll()
    {
        try {

            return SuperHeroResource::collection(SuperHero::all());

        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Something went wrong in SuperHeroController.showAll',
                'error' => $err->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {

            $superhero = SuperHero::findOrFail($id);

            return new SuperHeroResource($superhero);

        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Something went wrong in SuperHeroController.show',
                'error' => $err->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroRequest $request, int $id)
    {
        try {

            $superhero = SuperHero::findOrFail($id);

            $superhero->nombre = $request->nombre;
            $superhero->descripcion = $request->descripcion;

            $superhero->save();

            return response() -> json(['message' => 'Superhero details updated successfully']);
        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Something went wrong in SuperHeroController.update',
                'error' => $err->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {

            $superhero = SuperHero::find($id);
            $superhero->delete();

            return response() -> json([
                'Superhero deleted successfully', 200
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Something went wrong in SuperHeroController.destroy',
                'error' => $err->getMessage()
            ]);
        }
    }
}
