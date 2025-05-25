<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Tambahkan makanan yang dikonsumsi pengguna.
     */
    public function storeFoodEntry(Request $request)
    {

        // Validasi data input
        $validated = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'porsi' => 'required|numeric|min:1',
            'kalori_per_porsi' => 'required|numeric|min:0',
        ]);

        // Simpan data makanan ke dalam database
        Food::create([
            'user_id' => Auth::id(),
            'nama_makanan' => $validated['nama_makanan'],
            'porsi' => $validated['porsi'],
            'kalori_total' => $validated['porsi'] * $validated['kalori_per_porsi'],
        ]);

        return redirect('/home')->with('success', 'Makanan berhasil ditambahkan!');
    }
    
    public function updateFoodEntry(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'porsi' => 'required|numeric|min:1',
            'kalori_per_porsi' => 'required|numeric|min:0',
        ]);
    
        $foods = Food::where('user_id', Auth::id())->findOrFail($id);
        $foods->update([
            'nama_makanan' => $validated['nama_makanan'],
            'porsi' => $validated['porsi'],
            'kalori_total' => $validated['porsi'] * $validated['kalori_per_porsi'],
        ]);
    
        return redirect('/home')->with('success', 'Makanan berhasil diperbarui!');
    }

    public function deleteFoodEntry(Request $request, $id)
    {
            $foods = Food::where('user_id', Auth::id())->findOrFail($id);
    $foods->delete();

    return redirect('/home')->with('success', 'Makanan berhasil dihapus!');
    }

    /**
     * Pencarian makanan berdasarkan kata kunci.
     */
    public function searchFood(Request $request)
    {
        $query = $request->validate([
            'keyword' => 'required|string|max:255',
        ])['keyword'];

        // Cari makanan berdasarkan kata kunci
        $foods = Food::where('nama_makanan', 'like', '%' . $query . '%')
            ->get(['id', 'nama_makanan', 'kalori_per_porsi']);

        return view('beranda', [
            'user' => Auth::user(),
            'foods' => $foods,
            'keyword' => $query,
        ]);
    }

    /**
     * Dapatkan riwayat konsumsi makanan harian pengguna.
     */
    public function getDailyHistory()
    {
        // Ambil riwayat konsumsi makanan harian pengguna
        $history = Food::where('user_id', Auth::id())
            ->whereDate('created_at', now()->toDateString())
            ->get(['nama_makanan', 'porsi', 'kalori_total']);

        return view('riwayat', [
            'history' => $history,
        ]);
    }

    /**
     * Ambil data untuk beranda.
     */
    public function index()
    {
        $foods = Food::where('user_id', Auth::id())->get(); // Ambil data makanan milik user yang sedang login
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        return view('beranda', [
            'user' => $user,
            'foods' => $foods,
        ]);
    }
}