<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;

class LoginUserController extends Controller
{
    public function showLoginForm()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Identifiants incorrects.');
        }

        $client = Client::where('id', $user->client_id)->where('status', 'Actif')->first();

        $hasSubscription = Subscription::where('client_id', $client->id)->exists();

        if (!$client || !$hasSubscription) {
            return back()->with('error', "Votre entreprise n'a pas d'abonnement actif.");
        }

        // Connexion utilisateur manuelle
        Auth::login($user);

        $user->last_login_at = now();
$user->save();

        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
