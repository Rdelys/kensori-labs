<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Client;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $subscription = Subscription::create($request->only(['client_id', 'plan', 'start_date', 'end_date']));

        // Active automatiquement le client
        $subscription->client->update(['status' => 'Actif']);

        return redirect()->back()->with('success', 'Abonnement ajouté.');
    }

    public function update(Request $request, Subscription $subscription)
    {
        $subscription->update($request->only(['plan', 'start_date', 'end_date']));

        return redirect()->back()->with('success', 'Abonnement modifié.');
    }

   public function destroy(Subscription $subscription)
{
    $client = $subscription->client;

    $subscription->delete();

    // S'il n'a plus aucun abonnement, on le met Inactif
    if ($client->subscriptions()->count() === 0) {
        $client->update(['status' => 'Inactif']);
    }

    return redirect()->back()->with('success', 'Abonnement supprimé.');
}

}


