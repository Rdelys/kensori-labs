<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ClientController extends Controller
{
    public function store(Request $request)
    {
        Client::create([
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'Inactif',
        ]);
        return redirect()->back()->with('success', 'Client ajouté avec succès.');
    }

    public function update(Request $request, Client $client)
    {
        $client->update([
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->back()->with('success', 'Client modifié.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->back()->with('success', 'Client supprimé.');
    }

    public function dashboard() {
        $user = Auth::user();
        return view('client.dashboard', compact('user'));
    }

    public function parties() {
        $user = Auth::user();
        return view('client.parties', compact('user'));
    }

    public function swot() {
        $user = Auth::user();
        return view('client.swot', compact('user'));
    }

    public function processus() {
        $user = Auth::user();
        return view('client.processus', compact('user'));
    }

    public function politique() {
        $user = Auth::user();
        return view('client.politique', compact('user'));
    }
}
