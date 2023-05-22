<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = Car::$defaultFilters;
        if (\count($request->query()) > 0) {
            $filters = $request->query();
        }

        return view('admin.cars.list', [
            'cars' => Car::getByParams($filters),
            'brands' => Brand::all(),
            'fieldsToSort' => Car::$fieldsToSort,
            'equipmentSelection' => Car::$equipmentSelection,
            'typeSelection' => Car::$typeSelection,
            'engineSelection' => Car::$engineSelection,
            'filters' => $filters,
        ]);
    }


    public function create()
    {
        return view('admin.cars.add', [
            'brands' => Brand::all(),
            'equipmentSelection' => Car::$equipmentSelection,
            'typeSelection' => Car::$typeSelection,
            'engineSelection' => Car::$engineSelection,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $car = new Car();
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->type = $request->input('type');
        $car->equipment = $request->input('equipment');
        $car->price = $request->input('price');
        $car->engine = $request->input('engine');
        $car->brand()->associate(Brand::find($request->input('brand')));
        $car->save();

        return Redirect::to('/admin/cars');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('admin.cars.edit', [
            'car' => Car::find($id),
            'brands' => Brand::all(),
            'equipmentSelection' => Car::$equipmentSelection,
            'typeSelection' => Car::$typeSelection,
            'engineSelection' => Car::$engineSelection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car): RedirectResponse
    {
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->type = $request->input('type');
        $car->equipment = $request->input('equipment');
        $car->price = $request->input('price');
        $car->engine = $request->input('engine');
        $car->brand()->associate(Brand::find($request->input('brand')));
        $car->save();

        return Redirect::to('/admin/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Car::destroy($id);

        return Redirect::to('/admin/cars');
    }
}
