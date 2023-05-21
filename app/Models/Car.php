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

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public static function getByParams(array $params): Collection
    {
        $whereField = [
            'filter_brand' => 'brand_id',
            'filter_type' => 'type',
            'filter_equipment' => 'equipment',
            'filter_price' => "price",
            'filter_engine' => 'engine'
        ];
        $where = [];

        foreach ($params as $field => $value) {
            if (\array_key_exists($field, $whereField) && $value) {
                $where[] = [$whereField[$field], '=', $value];
            }
        }

        return Car::query()->where($where)->orderBy($params['sort'], $params['dir'])->get();
    }
}
