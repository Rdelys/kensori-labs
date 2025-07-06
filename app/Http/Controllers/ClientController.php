<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

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
}
