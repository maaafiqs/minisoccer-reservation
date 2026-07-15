<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code',
            'type' => 'required|in:nominal,percent',
            'discount_amount' => 'required|numeric|min:1',
        ]);

        Voucher::create([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'discount_amount' => $request->discount_amount,
            'is_active' => true,
        ]);

        return back()->with('success', 'Voucher berhasil ditambahkan.');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return back()->with('success', 'Voucher berhasil dihapus.');
    }
}
