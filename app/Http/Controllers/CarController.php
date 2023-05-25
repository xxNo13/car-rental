<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImages;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        $cars->load('car_images');
        return response()->json($cars);
    }

    public function show(string $id)
    {
        $car = Car::find($id);
        $car->load('car_images');
        return response()->json($car);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $car = Car::create([
            'car_brand' => $request->input('car_brand'),
            'car_model' => $request->input('car_model'),
            'plate_number' => $request->input('plate_number'),
        ]);

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                CarImages::create([
                    'image_url' => $image->store('images', 'public'),
                    'car_id' => $car->id,
                ]);
            }
        }


        return response()->json('The car successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::find($id);
        $car->load('car_images');
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Car::where('id', $id)->update([
            'car_brand' => $request->input('car_brand'),
            'car_model' => $request->input('car_model'),
            'plate_number' => $request->input('plate_number'),
        ]);

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                CarImages::create([
                    'image_url' => $image->store('images', 'public'),
                    'car_id' => $id,
                ]);
            }
        }

        return response()->json('The car successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $images = CarImages::where('car_id', $id)->get();
        if (count($images) > 0) {
            foreach ($images as $image) {
                unlink(storage_path('app/public/' . $image->image_url));
            }
        }
        Car::find($id)->delete();
        
        return response()->json('The car successfully deleted.');
    }

    public function deleteImage(string $id) {

        $image = CarImages::find($id);
        unlink(storage_path('app/public/' . $image->image_url));
        $image->delete();
        
        return response()->json('The car image successfully deleted.');
    }
}
