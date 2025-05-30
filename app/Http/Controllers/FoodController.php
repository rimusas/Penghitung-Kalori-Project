<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Ambil data untuk beranda.
     */
    public function index()
    {
        $user = Auth::user();
        $foods = Food::all(); // Semua data makanan
        $addedFoods = $user->foods ?? []; // Makanan yang sudah ditambahkan pengguna
        $totalCalories = $addedFoods->sum('kalori_total'); // Total kalori yang dikonsumsi pengguna

        /**
         * Rumus Penghitung Kalori Harris Benedict
         */

        $calories = ($user->jenisKelamin === 'Laki-laki')
            ? 66 + (13.7 * $user->berat) + (5 * $user->tinggi) - (6.78 * $user->umur)
            : 655 + (9.6 * $user->berat) + (1.8 * $user->tinggi) - (4.7 * $user->umur);

        $status = $totalCalories < $calories ? 'Kurang' : 'Normal';

        return view('beranda', compact('user', 'foods', 'addedFoods', 'totalCalories', 'calories', 'status'));
    }

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
    public function getDailyHistory(Request $request)
    {
        $query = $request->get('keyword', null);

        // Ambil riwayat konsumsi makanan harian pengguna
        $history = Food::where('user_id', Auth::id())
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('nama_makanan', 'like', '%' . $query . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get(['created_at','nama_makanan', 'porsi', 'kalori_total']);

        return view('riwayat', [
            'history' => $history,
        ]);
    }

    /**
     * Input Data Kalori Makanan Beserta Satuan
     */

}