<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna terdaftar (tersinkron dengan pendaftaran halaman publik).
     */
    public function index(): View
    {
        $users = User::latest()->paginate(12);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Hapus akun pelanggan dari database.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun admin yang sedang digunakan.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
