<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Subscription;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $now = Carbon::now();

        // Récupère tous les abonnements expirés
        $expiredSubscriptions = Subscription::where('end_date', '<', $now)->get();

        foreach ($expiredSubscriptions as $subscription) {
            $client = $subscription->client;

            // Supprime l'abonnement
            $subscription->delete();

            // Vérifie si le client n'a plus d'abonnement actif
            if ($client->subscriptions()->count() === 0) {
                $client->update(['status' => 'Inactif']);
            }
        }
    })->daily(); // Exécuté chaque jour
}
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
