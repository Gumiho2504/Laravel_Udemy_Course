<?php

namespace App\Http\Controllers\Api;

use App\CanLoadRalationships;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use CanLoadRalationships;

    public function __construct(){
        //$this->middleware("auth");

    }

    private  array $relations = ['user','attendees','attendees.user'];
    public function index()
    {
        //$events = Event::all();

        Gate::authorize('viewAny', Event::class);
        $query = $this->loadRelationships(Event::query());

        return EventResource::collection($query->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create(
            [
                ...$request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'start_time' => 'required|date',
                    'end_time' => 'required|date|after:start_date',
                ]),
                'user_id' => $request->user()->id,
            ]
        );
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //$event->load('user');
        return new EventResource(resource: $this->loadRelationships($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // if(Gate::denies('update-event', arguments: $event)){
        //     abort(403,'You are not authorized to update this event');
        // }

        //$this->authorize('update-event', $event);
       // Gate::authorize('update-event', $event);
       //dd($request->user()->id);
       Gate::authorize('update', $event);

       // The action is authorized...
        $event->update($request->validate(
            [
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ]
        ));
        return new EventResource(resource: $this->loadRelationships($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(
            [
                'message' => 'delete event successfully!'
            ]
        );
    }


}
