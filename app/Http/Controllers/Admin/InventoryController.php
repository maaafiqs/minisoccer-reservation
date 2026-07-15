<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryItem::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('inventory_category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->paginate(15)->withQueryString();
        $categories = InventoryCategory::orderBy('name')->get();

        // Chart Data: Total Quantity per Category
        $chartCategoryLabels = [];
        $chartCategoryData = [];
        foreach ($categories as $cat) {
            $chartCategoryLabels[] = $cat->name;
            $chartCategoryData[] = InventoryItem::where('inventory_category_id', $cat->id)->sum('quantity');
        }

        // Chart Data: Good vs Broken
        $totalBaik = (int) InventoryItem::where('status', 'baik')->sum('quantity');
        $totalRusak = (int) InventoryItem::where('status', 'rusak')->sum('quantity');

        return view('admin.inventory.index', compact('items', 'categories', 'chartCategoryLabels', 'chartCategoryData', 'totalBaik', 'totalRusak'));
    }

    public function print(Request $request)
    {
        $query = InventoryItem::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('inventory_category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->get();

        return view('admin.inventory.print', compact('items'));
    }

    public function create()
    {
        $categories = InventoryCategory::orderBy('name')->get();
        return view('admin.inventory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code' => 'required|string|max:50|unique:inventory_items',
            'inventory_category_id' => 'required|exists:inventory_categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:baik,rusak',
            'description' => 'nullable|string'
        ]);

        InventoryItem::create($validated);

        return redirect()->route('admin.inventory.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(InventoryItem $inventory)
    {
        $categories = InventoryCategory::orderBy('name')->get();
        return view('admin.inventory.edit', ['item' => $inventory, 'categories' => $categories]);
    }

    public function update(Request $request, InventoryItem $inventory)
    {
        $validated = $request->validate([
            'item_code' => 'required|string|max:50|unique:inventory_items,item_code,' . $inventory->id,
            'inventory_category_id' => 'required|exists:inventory_categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:baik,rusak',
            'description' => 'nullable|string'
        ]);

        $inventory->update($validated);

        return redirect()->route('admin.inventory.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(InventoryItem $inventory)
    {
        $inventory->delete();
        return back()->with('success', 'Barang berhasil dihapus.');
    }
}
