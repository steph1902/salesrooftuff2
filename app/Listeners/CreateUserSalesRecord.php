<?php

namespace App\Listeners;

// use IlluminateAuthEventsRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Sales; // Import the Sales model
use Illuminate\Auth\Events\Registered; // Import the Registered event



class CreateUserSalesRecord
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \IlluminateAuthEventsRegistered  $event
     * @return void
     */
    // public function handle(IlluminateAuthEventsRegistered $event)
    public function handle(Registered $event)
    {
        //
        $user = $event->user;
        // Create a sales record for the new user
        Sales::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'nama' => $user->name,
            'username' => $user->name,
            'password' => $user->password,
            

            'created_at' => now(),
            'updated_at' => now(),
            // Add other fields as necessary
        ]);
    }
}



