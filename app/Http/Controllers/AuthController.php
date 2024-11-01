<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    protected $firebaseAuthUrl = 'https://identitytoolkit.googleapis.com/v1/accounts';

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            $client = new Client();
            $response = $client->post("{$this->firebaseAuthUrl}:signInWithPassword?key=" . env('FIREBASE_API_KEY'), [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                    'returnSecureToken' => true,
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['idToken'])) {
                Session::put('idToken', $responseData['idToken']);
                Session::put('firebase_email', $request->email);
                return redirect()->route('productos.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['loginError' => 'Error al iniciar sesión']);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required',
            'username' => 'required',
        ]);

        try {
            $client = new Client();
            $response = $client->post("{$this->firebaseAuthUrl}:signUp?key=" . env('FIREBASE_API_KEY'), [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                    'returnSecureToken' => true,
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['idToken'])) {
                Session::put('idToken', $responseData['idToken']);
                Session::put('firebase_email', $request->email);
                return redirect()->route('productos.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['registerError' => 'Error al registrar']);
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Implementar el método de recuperación de contraseña con Firebase
        return redirect()->back()->withErrors(['resetError' => 'Recuperación de contraseña no implementada']);
    }

    public function signout(Request $request)
    {
        // Limpiar la sesión y cerrar la sesión del usuario
        Session::forget('idToken');
        Session::forget('firebase_email');
        Session::flush();

        // Redirigir al usuario a la página de inicio de sesión
        return redirect()->route('login');
    }

}
