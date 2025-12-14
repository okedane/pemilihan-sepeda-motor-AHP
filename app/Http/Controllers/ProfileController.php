<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // dd($request->all(), $user);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ]);

        try {
            // Hash password jika diubah
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                // Jangan update password jika kosong
                unset($validatedData['password']);
            }

            $user->Update($validatedData);
            return redirect()->back()->with('success', 'Akun Berhasil di Dirubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Merubah Akun, Email Sudah Ada');
        }
    }

    public function foto(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($user->foto && Storage::exists('public/' . $user->foto)) {
                    Storage::delete('public/' . $user->foto);
                }
                $validatedData['foto'] = $request->file('foto')->store('profile', 'public');
            }

            $user->Update($validatedData);
            return redirect()->back()->with('success', 'Foto Profile Berhasil di Dirubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Merubah Foto Profile');
        }
    }

    public function reset(User $user)
    {
        try {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                // Hapus file foto dari folder public
                Storage::delete('public/' . $user->foto);
            }

            // Set kolom foto menjadi null
            $user->update(['foto' => null]);

            return redirect()->back()->with('success', 'Foto Profile Berhasil di Direset');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mereset Foto Profile');
        }
    }
}
