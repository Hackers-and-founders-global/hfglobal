<?php

namespace App\Listeners;

use App\Mail\WelcomeUser;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeUserNotification
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
   * @param  \Illuminate\Auth\Events\Verified  $event
   * @return void
   */
  public function handle(Verified $event)
  {
    $user = auth()->user();
    Mail::to($user->email)->send(new WelcomeUser($user));
  }
}
