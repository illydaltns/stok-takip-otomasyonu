<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class AdminUserController extends Controller
{
    // Sadece adminlerin erişebilmesi için yetki kontrolü
    public function __construct()
    {
        $this->middleware('auth'); // Giriş yapmış kullanıcılar için
    }

    // Kullanıcıları listele
    public function index()
    {
        Gate::authorize('manage-users'); // Yetki kontrolü
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Yeni kullanıcı ekleme formunu göster
    public function create()
    {
        Gate::authorize('manage-users'); // Yetki kontrolü
        return view('admin.users.create');
    }

    // Yeni kullanıcıyı kaydet
    public function store(Request $request)
    {
        Gate::authorize('manage-users'); // Yetki kontrolü
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(12)), // Rastgele şifre atandı
            'role' => $request->role,
        ]);

        try {
            // Laravel'in kendi şifre sıfırlama sistemini kullan
            $status = Password::sendResetLink(
                ['email' => $user->email]
            );

            if ($status === Password::RESET_LINK_SENT) {
                return redirect()->route('admin.users.index')
                    ->with('success', 'Kullanıcı başarıyla eklendi. Şifre sıfırlama maili gönderildi.');
            } else {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Kullanıcı eklendi fakat şifre sıfırlama maili gönderilemedi.');
            }
        } catch (\Exception $e) {
            \Log::error('Şifre sıfırlama maili gönderme hatası: ' . $e->getMessage());
            return redirect()->route('admin.users.index')
                ->with('error', 'Kullanıcı eklendi fakat şifre sıfırlama maili gönderilemedi.');
        }
    }

    // Kullanıcı düzenleme formunu göster
    public function edit(User $user)
    {
        Gate::authorize('manage-users'); // Yetki kontrolü
        return view('admin.users.edit', compact('user'));
    }

    // Kullanıcıyı güncelle
    public function update(Request $request, User $user)
    {
        Gate::authorize('manage-users'); // Yetki kontrolü
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    // Kullanıcıyı sil
    public function destroy(User $user)
    {
        Gate::authorize('manage-users'); // Yetki kontrolü
        // Kendi hesabını silmesini engelle
        if (auth()->user()->id === $user->id) {
            return back()->with('error', 'Kendi hesabınızı silemezsiniz.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }

    // Şifre sıfırlama maili gönder
    public function sendPasswordResetLink(User $user)
    {
        Gate::authorize('manage-users'); // Yetki kontrolü

        try {
            // Laravel'in kendi şifre sıfırlama sistemini kullan
            $status = Password::sendResetLink(
                ['email' => $user->email]
            );

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('success', 'Şifre sıfırlama maili gönderildi.');
            } else {
                return back()->with('error', 'Şifre sıfırlama maili gönderilemedi.');
            }
        } catch (\Exception $e) {
            \Log::error('Şifre sıfırlama maili gönderme hatası: ' . $e->getMessage());
            return back()->with('error', 'Şifre sıfırlama maili gönderilirken bir hata oluştu.');
        }
    }
} 