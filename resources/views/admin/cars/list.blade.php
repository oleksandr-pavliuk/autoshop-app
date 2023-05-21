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

        .pay {
            margin-right: 13px;
            margin-left: 7px;
        }

        nav.breadcrumb {
            font-size: 22px;
            margin-left: 223px;
        }
    </style>
    <nav class="breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/students">Cars</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>
{{--    <form class="filter-search" action="/admin/students" method="GET">--}}
{{--        <label for="filter_rating">Rating</label>--}}
{{--        <input class="form-control number" id="filter_rating" type="number" min="1" max="100" name="filter_rating" value="{{ isset($filters['filter_rating']) ? $filters['filter_rating'] : '' }}"/>--}}
{{--        <label for="filter_dormitory">Dormitory</label>--}}
{{--        <select class="form-select number" id="filter_dormitory" name="filter_dormitory">--}}
{{--            <option value="0" selected>All</option>--}}
{{--            @foreach ($dormitories as $dormitory)--}}
{{--                <option value="{{ $dormitory->id }}" {{ (isset($filters['filter_dormitory']) && $dormitory->id == $filters['filter_dormitory']) ? 'selected' : ''}}>{{ $dormitory->number }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}

{{--        <label for="sort">Sort By</label>--}}
{{--        <select class="form-select" id="sort" name="sort" onselect="{{ $filters['sort'] }}">--}}
{{--            @foreach ($fieldsToSort as $field => $label)--}}
{{--                <option value="{{ $field }}" {{ ($field == $filters['sort']) ? 'selected' : ''}}>{{ $label }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}

{{--        <label for="dir">Direction</label>--}}
{{--        <select class="form-select" id="dir" name="dir">--}}
{{--            <option value="asc" {{ ("asc" == $filters['dir']) ? 'selected' : ''}}>To High</option>--}}
{{--            <option value="desc" {{ ("desc" == $filters['dir']) ? 'selected' : ''}}>To Low</option>--}}
{{--        </select>--}}

{{--        <input class="search btn btn-secondary" type="submit" value="Search">--}}

{{--        <a href="/admin/students/create" class="btn btn-success add-new">Add Student</a>--}}
{{--    </form>--}}
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
                <td>{{ $car->model }}</td>
                <td>{{ $car->year }}</td>
                <td>{{ $car->type }}</td>
                <td>{{ $car->equipment}}</td>
                <td>{{ $car->price }}</td>
                <td>{{ $car->engine }}</td>
                <td>{{ $car->brand->name }}</td>
                <td>
                    <a class="btn btn-warning pay" href="/admin/students/{{ $car->id }}/scholarship-payment">Pay Scholarship</a>
                    <a class="btn btn-primary" href="/admin/students/{{ $car->id }}/edit">Edit</a>
                    <form style="float:right; padding: 0 15px;"
                          action="/admin/students/{{ $car->id }}" method="POST">
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
