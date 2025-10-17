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

    public function raci() {
        $user = Auth::user();
        return view('client.raci', compact('user'));
    }

    public function revu() {
        $user = Auth::user();
        return view('client.revu', compact('user'));
    }

    public function risques() {
        $user = Auth::user();
        return view('client.risques', compact('user'));
    }

    public function objectifs() {
        $user = Auth::user();
        return view('client.objectifs', compact('user'));
    }

    public function plani() {
        $user = Auth::user();
        return view('client.plani', compact('user'));
    }

    public function docs() {
        $user = Auth::user();
        return view('client.docs', compact('user'));
    }
}
