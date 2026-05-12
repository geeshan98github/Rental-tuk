<?php

namespace App\Listeners;

use App\Models\ApiActivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApiLogActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $object = $event->object;

        ApiActivity::create([
            'description' => class_basename(get_class($object)) . ' ' . ($object->id ?? 'unknown') . ' has been ' . $event->description,
            'subject_id' => $object->id ?? null,
            'subject_type' => get_class($object),
            'user_id' => request()->user()->id(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
        ]);
    }
}
