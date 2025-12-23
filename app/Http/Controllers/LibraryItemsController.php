<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryItemRequest;
use App\Models\LibraryItem;
use Illuminate\Http\Request;

class LibraryItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LibraryItem::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
        }
        $library = $query->paginate(10)->through(function ($library) {
            return [
                'id' => $library->id,
                'title' => $library->title,
                'type' => $library->type,
                'author_name' => $library->author_name,
                'status' => $library->status,
                'created_at' => $library->created_at_human,
            ];
        });

        return response()->json($library);
    }

    /**
     * Edit a newly created resource in storage.
     */
    public function edit($id)
    {
        $item = LibraryItem::findOrFail($id);

        return response()->json([
            'message' => 'Library item edit request successful.',
            'data' => $item,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LibraryItemRequest $request)
    {
        $validated = $request->validated();
        $item = LibraryItem::create($validated);

        return response()->json([
            'message' => 'Library item created successfully.',
            'data' => $item,
        ], 201);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LibraryItemRequest $request)
    {
        $item = LibraryItem::findOrFail($request->input('id'));

        $item->update($request->except('id')); // Exclude id from update

        return response()->json([
            'message' => 'Library item updated successfully.',
            'data' => $item->refresh(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = LibraryItem::findOrFail($id);
        $item->delete();
        $item->borrowings()->delete();

        return response()->json([
            'message' => 'Library item deleted successfully.',
            'data' => $item->refresh(),
        ], 200);
    }
   
}
