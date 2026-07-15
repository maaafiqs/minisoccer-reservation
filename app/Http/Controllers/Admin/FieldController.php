<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = \App\Models\Field::all();
        return view('admin.fields.index', compact('fields'));
    }

    public function create()
    {
        return view('admin.fields.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weekday_day_price' => 'required|integer|min:0',
            'weekday_night_price' => 'required|integer|min:0',
            'weekend_price' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('fields', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        \App\Models\Field::create($validated);

        return redirect()->route('admin.fields.index')->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function edit(\App\Models\Field $field)
    {
        return view('admin.fields.edit', compact('field'));
    }

    public function update(Request $request, \App\Models\Field $field)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weekday_day_price' => 'required|integer|min:0',
            'weekday_night_price' => 'required|integer|min:0',
            'weekend_price' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('fields', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $field->update($validated);

        return redirect()->route('admin.fields.index')->with('success', 'Data lapangan berhasil diperbarui.');
    }

    public function destroy(\App\Models\Field $field)
    {
        $field->delete();
        return redirect()->route('admin.fields.index')->with('success', 'Lapangan berhasil dihapus.');
    }
}
