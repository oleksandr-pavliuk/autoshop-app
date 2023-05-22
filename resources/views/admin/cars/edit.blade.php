@extends('layouts.app')
<style >
    label {
        min-width: 150px;
        display: inline-block;
        float: left;
    }

    .form-control, .form-select {
        width: 40% !important;
    }

    form {
        text-align: center;
        margin: auto;
        width: 70% !important;
    }

    nav.breadcrumb {
        font-size: 22px;
        margin-left: 223px;
    }

    .save-btn {
        margin-left: 13px;
    }
</style>
@section('content')
    <nav class="breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/cars">Cars</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Car #{{ $car->id }}</li>
        </ol>
    </nav>
    <form action="/admin/cars/{{ $car->id }}" method="POST" style="width: 800px;">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <label for="brand">Brand</label>
        <select class="form-select number mb-3" id="brand" name="brand">
            <option value="0" selected>All</option>
            @foreach ($brands as $brand)
                <option {{ ($brand->id == $car->brand->id) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>

        <label for="model">Model</label>
        <input id="model" class="form-control mb-3" type="text" name="model" value="{{ $car->model }}">

        <label for="equipment">Equipment</label>
        <select class="form-select number mb-3" id="equipment" name="equipment">
            <option value="0" selected>All</option>
            @foreach ($equipmentSelection as $equipment)
                <option {{ ($equipment == $car->equipment) ? 'selected' : '' }} value="{{ $equipment }}">{{ \ucfirst($equipment) }}</option>
            @endforeach
        </select>

        <label for="type">Type</label>
        <select class="form-select number mb-3" id="type" name="type">
            <option value="0" selected>All</option>
            @foreach ($typeSelection as $type)
                <option {{ ($type == $car->type) ? 'selected' : '' }} value="{{ $type }}">{{ \ucfirst($type) }}</option>
            @endforeach
        </select>

        <label for="engine">Engine</label>
        <select class="form-select number mb-3" id="engine" name="engine">
            <option value="0" selected>All</option>
            @foreach ($engineSelection as $engine)
                <option {{ ($engine == $car->engine) ? 'selected' : '' }} value="{{ $engine }}">{{ \ucfirst($engine) }}</option>
            @endforeach
        </select>

        <label for="year">Year</label>
        <input id="year" class="form-control mb-3" type="number" min="2000" max="2023" name="year" value="{{ $car->year }}">

        <label for="price">Price</label>
        <input id="price" class="form-control mb-3" type="number" min="30000" max="100000" name="price" value="{{ $car->price }}">

        <input class="btn btn-success save-btn" type="submit" value="Save">
    </form>
@endsection
