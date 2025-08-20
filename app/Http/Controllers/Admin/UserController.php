<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna dengan paginasi.
     */
    public function index()
    {
        // Ambil data pengguna, urutkan dari yang terbaru, dan gunakan paginasi
        $users = User::latest()->paginate(10);

        // Mengembalikan view dengan data pengguna
        // Catatan: Anda perlu membuat view 'admin.users.index' yang berisi tabel pengguna Anda.
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Menampilkan form untuk mengedit data pengguna.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna di dalam database.
     */
    public function update(Request $request, User $user)
    {
        // Validasi data yang masuk dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Pastikan email unik, kecuali untuk pengguna ini sendiri
            ],
            'phone' => 'nullable|string|max:20',
            'is_admin' => 'sometimes|boolean', // 'sometimes' berarti hanya validasi jika ada di request
        ]);

        // Perbarui data pengguna
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];

        // Atur role admin berdasarkan checkbox. Jika tidak dicentang, nilainya akan false.
        $user->is_admin = $request->has('is_admin');

        $user->save(); // Simpan perubahan

        // Redirect kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Hapus pengguna dari database
        $user->delete();

        // Redirect kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil dihapus!');
    }
}
