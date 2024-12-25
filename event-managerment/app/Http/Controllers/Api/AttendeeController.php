<?php

namespace App\Http\Controllers\Api;

use App\CanLoadRalationships;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use CanLoadRalationships;
    public array $relations = ['user'];
    public function index(Event $event)
    {
        $attendees = $this->loadRelationships( $event->attendees()->latest());

        return AttendeeResource::collection($attendees->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create(
            ['user_id' => 1]
        );
        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event , Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event , Attendee $attendee)
    {
        Gate::authorize('delete-attendee', $event,$attendee);
        $attendee->delete();
        return response(status: 204);
    }
}
