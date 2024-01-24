<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class ProductController extends Controller
{
    public function toggleFeature(Request $request, $productId)
    {
        $product = Blog::findOrFail($productId);
        $product->status = $request->input('status');
        $product->save();

        // Return a response indicating success or any other relevant information
        return response()->json(['message' => 'Status updated successfully']);
    }
}