<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CO2Controller extends Controller
{
    /**
     * [PBI-01] ADMIN: Create a new category and define its CO2 constant
     */
    public function addCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:45|unique:categories,category_name',
            'co2_constant' => 'required|numeric|min:0'
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
            'co2_constant' => $request->co2_constant
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category and CO2 constant defined successfully!',
            'data' => $category
        ], 201);
    }

    /**
     * [PBI-01] ADMIN: Update an existing CO2 constant
     */
    public function updateCategoryCO2(Request $request, $id)
    {
        $request->validate([
            'co2_constant' => 'required|numeric|min:0'
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        $category->co2_constant = $request->co2_constant;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'CO2 constant updated successfully!',
            'data' => $category
        ]);
    }

    /**
     * [PBI-01] ADMIN: Delete a category
     */
    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false, 
                'message' => 'Category not found.'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!'
        ]);
    }
}