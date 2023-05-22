@extends('layouts.app')
@section('content')
    <style>
        a.add-new {
            float: right;
            display: inline-block;
        }

        form.filter-search {
            margin: 20px auto;
            width: 70%;
        }

        form.filter-search label {
            margin-right: 5px;
        }

        #dir {
            width: 11% !important;
        }

        form.filter-search .number {
            width: 8% !important;
        }

        form.filter-search input, select {
            margin-right: 20px;
            width: 13% !important;
            display: inline-block !important;
        }

        form.filter-search input.search {
            margin-right: 0;
            width: 100px !important;
        }

        label {
            font-weight: bold;
        }

        table {
            text-align: center;
            margin: auto;
            width: 70% !important;
        }

        table tr {
            vertical-align: middle;
        }

        nav.breadcrumb {
            font-size: 22px;
            margin-left: 223px;
        }

        .first-filter-row {
            margin-bottom: 17px;
        }
    </style>
    <nav class="breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/cars">Cars</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>
    <form class="filter-search" action="/admin/cars" method="GET">
        <div class="first-filter-row">
            <label for="filter_brand">Brand</label>
            <select class="form-select number" id="filter_brand" name="filter_brand">
                <option value="0" selected>All</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ (isset($filters['filter_brand']) && $brand->id == $filters['filter_brand']) ? 'selected' : ''}}>{{ $brand->name }}</option>
                @endforeach
            </select>

            <label for="filter_equipment">Equipment</label>
            <select class="form-select number" id="filter_equipment" name="filter_equipment">
                <option value="0" selected>All</option>
                @foreach ($equipmentSelection as $equipment)
                    <option value="{{ $equipment }}" {{ (isset($filters['filter_equipment']) && $equipment == $filters['filter_equipment']) ? 'selected' : ''}}>{{ \ucfirst($equipment) }}</option>
                @endforeach
            </select>

            <label for="filter_type">Type</label>
            <select class="form-select number" id="filter_type" name="filter_type">
                <option value="0" selected>All</option>
                @foreach ($typeSelection as $type)
                    <option value="{{ $type }}" {{ (isset($filters['filter_type']) && $type == $filters['filter_type']) ? 'selected' : ''}}>{{ \ucfirst($type) }}</option>
                @endforeach
            </select>

            <label for="filter_engine">Engine</label>
            <select class="form-select number" id="filter_engine" name="filter_engine">
                <option value="0" selected>All</option>
                @foreach ($engineSelection as $engine)
                    <option value="{{ $engine }}" {{ (isset($filters['filter_engine']) && $engine == $filters['filter_engine']) ? 'selected' : ''}}>{{ \ucfirst($engine) }}</option>
                @endforeach
            </select>

            <label for="sort">Sort By</label>
            <select class="form-select" id="sort" name="sort" onselect="{{ $filters['sort'] }}">
                @foreach ($fieldsToSort as $field => $label)
                    <option value="{{ $field }}" {{ ($field == $filters['sort']) ? 'selected' : ''}}>{{ $label }}</option>
                @endforeach
            </select>

            <label for="filter_model">Model</label>
            <input class="form-control number" id="filter_model" type="text" name="filter_model" value="{{ isset($filters['filter_model']) ? $filters['filter_model'] : '' }}"/>
        </div>
        <div class="second-filter-row">
            <label for="filter_year">Year</label>
            <input class="form-control number" id="filter_year" type="number" min="2000" max="2024" name="filter_year" value="{{ isset($filters['filter_year']) ? $filters['filter_year'] : '' }}"/>

            <label for="filter_price_from">Price From</label>
            <input class="form-control number" id="filter_price_from" type="number" min="30000" max="100000" name="filter_price_from" value="{{ isset($filters['filter_price_from']) ? $filters['filter_price_from'] : '' }}"/>

            <label for="filter_price_to">Price To</label>
            <input class="form-control number" id="filter_price_to" type="number" min="30000" max="100000" name="filter_price_to" value="{{ isset($filters['filter_price_to']) ? $filters['filter_price_to'] : '' }}"/>

            <label for="dir">Direction</label>
            <select class="form-select" id="dir" name="dir">
                <option value="asc" {{ ("asc" == $filters['dir']) ? 'selected' : ''}}>To High</option>
                <option value="desc" {{ ("desc" == $filters['dir']) ? 'selected' : ''}}>To Low</option>
            </select>

            <input class="search btn btn-secondary" type="submit" value="Search">

            <a href="/admin/cars/create" class="btn btn-success add-new">Add Сar</a>
        </div>
    </form>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Model</th>
            <th>Year</th>
            <th>Type</th>
            <th>Equipment</th>
            <th>Price</th>
            <th>Engine</th>
            <th>Brand</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cars as $car)
            <tr>
                <td>{{ \strtoupper($car->model) }}</td>
                <td>{{ $car->year }}</td>
                <td>{{ \ucfirst($car->type) }}</td>
                <td>{{ \ucfirst($car->equipment) }}</td>
                <td>{{ $car->price }}</td>
                <td>{{ \ucfirst($car->engine) }}</td>
                <td>{{ $car->brand->name }}</td>
                <td>
                    <a class="btn btn-primary" href="/admin/cars/{{ $car->id }}/edit">Edit</a>
                    <form style="float:right; padding: 0 15px;"
                          action="/admin/cars/{{ $car->id }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if (\count($cars) == 0)
            <tr>
                <td colspan="7">Records not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
