<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
   
    #REGISTER (REFRACTOR: Extract Method + Response Wrapper)
    
    public function register(Request $request)
    {
        $validated = $this->validateRegisterData($request);

        $user = $this->createUser($validated);

        $token = $this->generateToken($user);

        return $this->success(
            message: "Registrasi berhasil",
            data: [
                "user" => $user,
                "token" => $token
            ],
            status: 201
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error("Username atau password salah", 401);
        }

        $token = $this->generateToken($user);

        return $this->success("Login berhasil", [
            "user" => $user,
            "token" => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success("Logout berhasil");
    }

    public function profile(Request $request)
    {
        return $this->success("Data profil berhasil diambil", $request->user());
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return $this->success("Profil berhasil diperbarui", $user);
    }


    #PRIVATE METHODS (Extract Method)
    private function validateRegisterData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    }

    private function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'gender' => $data['gender'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',
        ]);
    }

    private function generateToken(User $user)
    {
        return $user->createToken('auth_token')->plainTextToken;
    }


    #RESPONSE WRAPPER (Encapsulate Data)

    private function success(string $message, $data = null, int $status = 200)
    {
        return response()->json([
            "success" => true,
            "message" => $message,
            "data" => $data
        ], $status);
    }

    private function error(string $message, int $status = 400)
    {
        return response()->json([
            "success" => false,
            "message" => $message
        ], $status);
    }
}