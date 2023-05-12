<?php

namespace App\Listeners;

use App\User;
use Carbon\Carbon ;
use OwenIt\Auditing\Models\Audit ;
class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {

        $data = [
            'auditable_id' => auth()->user()->id,
            'auditable_type' => User::class,
            'event'      => "login",
            'url'        => request()->fullUrl(),
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id'          => auth()->user()->id,
            'user_type' => User::class,
        ];

        //create audit trail data
        $details = Audit::create($data);
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {

        $data = [
            'auditable_id' => auth()->user()->id,
            'auditable_type' => User::class,
            'event'      => "logout",
            'url'        => request()->fullUrl(),
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id'    => auth()->user()->id,
            'user_type' => User::class,
        ];

        //create audit trail data
        $details = Audit::create($data);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@handleUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@handleUserLogout'
        );
    }
}