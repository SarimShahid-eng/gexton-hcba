<?php

namespace App\Http\Controllers\Library;

use App\Models\Borrowing;
use App\Models\LibraryItem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowLibraryItemRequest;

class BorrowingLibraryItemController extends Controller
{
    /**
     * Display a listing of borrowing records (with optional search).
     */
    // public function index(Request $request)
    // {
    //     $query = Borrowing::with(['user', 'libraryItem']);

    //     if ($request->has('search')) {
    //         $search = $request->input('search');

    //         $query->whereHas('libraryItem', function ($q) use ($search) {
    //             $q->where('title', 'like', "%{$search}%")
    //                 ->orWhere('type', 'like', "%{$search}%")
    //                 ->orWhere('rfid_tag', 'like', "%{$search}%");
    //         })->orWhereHas('user', function ($q) use ($search) {
    //             $q->where('name', 'like', "%{$search}%")
    //                 ->orWhere('email', 'like', "%{$search}%");
    //         });
    //     }

    //     $borrows = $query->latest()->paginate(10)->through(function ($borrow) {
    //         return [
    //             'id' => $borrow->id,
    //             'user_name' => $borrow->user->name,
    //             'user_email' => $borrow->user->email,
    //             'item_title' => $borrow->libraryItem->title,
    //             'item_type' => $borrow->libraryItem->type,
    //             'item_rfid' => $borrow->libraryItem->rfid_tag,
    //             'borrow_date' => $borrow->borrow_date,
    //             'return_date' => $borrow->return_date,
    //             'status' => $borrow->status,
    //             'created_at' => $borrow->created_at->diffForHumans(),
    //         ];
    //     });

    //     return response()->json($borrows);
    // }

    /**
     * Show details of a specific borrowing record (for editing/viewing).
     */
    public function edit($id)
    {
        $borrow = Borrowing::with(['user', 'libraryItem'])->findOrFail($id);

        return response()->json([
            'message' => 'Borrowing record retrieved successfully.',
            'data' => $borrow,
        ], 200);
    }

    /**
     * Store a new borrowing record (borrow an item).
     */
    public function store(BorrowLibraryItemRequest $request)
    {
 
        $validated = $request->validated();
        // Remove cnic_number from the validated data
        unset($validated['cnic_number']);
        // $validated['borrow_date'] = now();
        // $validated['status'] = 'borrowed';

        $borrow = Borrowing::create($validated);

        // Optionally update library item status to checked_out
        // LibraryItem::where('id', $borrow->library_item_id)
        //     ->update(['status' => 'borrowed']);

        return response()->json([
            'message' => 'Item has been successfully borrowed.',
            'data' => $borrow->load(['user', 'libraryItem']),
        ], 201);
    }

    /**
     * Update a borrowing record (e.g., mark as returned or extend).
     */
    public function update(BorrowLibraryItemRequest $request)
    {
        $borrow = Borrowing::findOrFail($request->input('id'));

        $borrow->update($request->except('id'));

        // If status changed to 'returned', update library item status back to available
        if ($borrow->fresh()->status === 'returned') {
            LibraryItem::where('id', $borrow->library_item_id)
                ->update(['status' => 'available']);
        }

        return response()->json([
            'message' => 'Borrowing record updated successfully.',
            'data' => $borrow->refresh()->load(['user', 'libraryItem']),
        ], 200);
    }

    /**
     * Delete/cancel a borrowing record (admin only).
     */
    // public function destroy($id)
    // {
    //     $borrow = Borrowing::findOrFail($id);

    //     // Revert item status if currently borrowed
    //     if ($borrow->status === 'borrowed') {
    //         LibraryItem::where('id', $borrow->library_item_id)
    //             ->update(['status' => 'available']);
    //     }

    //     $borrow->delete();

    //     return response()->json([
    //         'message' => 'Borrowing record deleted successfully.',
    //     ], 200);
    // }
}
