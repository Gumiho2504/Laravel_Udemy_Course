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
        Gate::authorize('view-any', arguments: Attendee::class);
        $attendees = $this->loadRelationships( $event->attendees()->latest());

        return AttendeeResource::collection($attendees->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        Gate::authorize('create', Attendee::class);
        $attendee = $event->attendees()->create(
            ['user_id' => $request->user()->id]
        );
        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event , Attendee $attendee)
    {
        Gate::authorize('view',$attendee);
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
        Gate::authorize('delete', $attendee);
        $attendee->delete();
        return response(status: 204);
    }
}
