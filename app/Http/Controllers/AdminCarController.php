<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
            'filters' => $filters,
        ]);
    }


    public function create()
    {
        return view('admin.cars.add', ['brands' => Brand::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $car = new Student();
        $car->model = $request->input('model');
        $car->year= $request->input('year');
        $car->type = $request->input('type');
        $car->equipment = $request->input('equipment');
        $car->price = $request->input('price');
        $car->engine = $request->input('engine');
        $car->brand()->associate(Brand::find($request->input('brand')));
        $car->save();

        return Redirect::to('/admin/cars/list');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('admin.cars.view', ["car" => Car::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('admin.cars.edit', [
            'cars' => Car::find($id),
            'brands' => Brand::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car) : RedirectResponse
    {
        $car->model = $request->input('model');
        $car->year= $request->input('year');
        $car->type = $request->input('type');
        $car->equipment = $request->input('equipment');
        $car->price = $request->input('price');
        $car->engine = $request->input('engine');
        $car->brand()->associate(Brand::find($request->input('brand')));
        $car->save();

        return Redirect::to('/admin/cars/list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Car::destroy($id);

        return Redirect::to('/admin/cars/list');
    }
}
