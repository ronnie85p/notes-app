<?php

namespace App\Services\Products;

use Illuminate\Support\Facades\DB;
use App\Models\Products\Category;

class CategoriesHandlerService
{
    public static function getList(int $parent_id = 0)
    {
        $items = Category::where('parent_id', $parent_id)->get();
        foreach ($items as &$item) {
            $item['items'] = self::getList($item['id']);
        }

        return $items;
    }

    public static function createCategory(array $data)
    {
        DB::transaction(function() use($data): Category {
            $category = Category::create($data);

            return $category;
        });
    }

    public static function updateCategory($id, array $data)
    {
        return DB::transaction(function () use ($id, $data): Category {
            $category= Category::findOrFail($id);
            $category->update($data);

            return $book;
        });
    }

    public static function deleteCategory($id)
    {
        $deleted = Category::destroy($id);

        return [$deleted];
    }
}