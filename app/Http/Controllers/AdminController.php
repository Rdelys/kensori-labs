<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function dashboard(Request $request)
{
    $clientId = $request->query('client_id', 'all');

    if ($clientId === 'all') {
        $totalClients = Client::count();
        $totalUsers = User::count();
        $totalSubscriptions = Subscription::count();
    } else {
        $totalClients = Client::where('id', $clientId)->count();
        $totalUsers = User::where('client_id', $clientId)->count();
        $totalSubscriptions = Subscription::where('client_id', $clientId)->count();
    }

    return response()->json([
        'totalClients' => $totalClients,
        'totalUsers' => $totalUsers,
        'totalSubscriptions' => $totalSubscriptions,
    ]);
}

}
