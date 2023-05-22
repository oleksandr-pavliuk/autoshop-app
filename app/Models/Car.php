<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    public static array $fieldsToSort = [
        "model" => "Model",
        "year" => "Year",
        "price" => "Price"
    ];
    public static array $defaultFilters = [
        "sort" => "model",
        "dir" => "desc"
    ];

    public static array $equipmentSelection = [
        "basic", "medium", "premium", "S", "SE", "titanium"
    ];

    public static array $engineSelection = [
        "petrol", "gas", "diesel", "electro"
    ];

    public static array $typeSelection = [
        "sedan", "station wagon", "crossover", "hatchback", "SUV"
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public static function getByParams(array $params): Collection
    {
        $whereField = [
            'filter_model' => 'model',
            'filter_brand' => 'brand_id',
            'filter_year' => 'year',
            'filter_type' => 'type',
            'filter_equipment' => 'equipment',
            'filter_engine' => 'engine',
            'filter_price_from' => 'price',
            'filter_price_to' => 'price',
        ];
        $where = [];

        foreach ($params as $field => $value) {
            if (!\array_key_exists($field, $whereField) || !$value) {
                continue;
            }

            if ($field == 'filter_price_from') {
                $where[] = [$whereField[$field], '>', $value];
                continue;
            }

            if ($field == 'filter_price_to') {
                $where[] = [$whereField[$field], '<', $value];
                continue;
            }

            if ($field == 'filter_model') {
                $where[] = [$whereField[$field], 'like', '%' . $value . '%'];
                continue;
            }

            $where[] = [$whereField[$field], '=', $value];
        }

        return Car::query()->where($where)->orderBy($params['sort'], $params['dir'])->get();
    }
}
