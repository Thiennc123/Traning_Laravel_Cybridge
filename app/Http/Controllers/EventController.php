<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

use App\Imports\EventsImport;
use Excel;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::orderBy('id', 'desc')->paginate(10);




        foreach ($event as $item) {
            $item['countGuest'] = $item->guests->count();
        }


        return view('eventViews.listEvent', ['listEvents' => $event]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('eventViews.addEvent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $event = new Event;
        if ($request->hasfile('file')) {

            $file = $request->file('file');




            $extension = $file->getClientOriginalExtension();
            $filename = rand() . '.' . $extension;


            Storage::disk('public')->put($filename, file_get_contents($file));
            $url = Storage::url($filename);
            $event->image = $url;
        }



        $event->name = $request->name;
        $event->content = $request->content;

        $event->status = "public";
        $event->user_id = auth()->id();
        $event->save();


        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $event = Event::find($id);

        return view('eventViews.editEvent', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->file('file')) {

            $file = $request->file('file');




            $extension = $file->getClientOriginalExtension();
            $filename = rand() . '.' . $extension;


            Storage::disk('public')->put($filename, file_get_contents($file));
            $url = Storage::url($filename);
        }
        Event::find($id)->update([
            'name' => $request->name,
            'content' => $request->content,
            'status' => "public",
            'user_id' => auth()->id(),
            'image' => $url,
        ]);



        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->route('events.index');
    }


    public function showimportEvent()
    {
        return view('eventViews.importEvent');
    }


    public function importEvent(Request $request)
    {
        Excel::import(new EventsImport, $request->file);
        $event = Event::orderBy('id', 'desc')->paginate(10);

        return view('eventViews.listEvent', ['listEvents' => $event]);
    }
}
