<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\EventRepositories\EventRepositoryInterface;
use App\Imports\EventsImport;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Excel;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $eventRepo;

    public function __construct(EventRepositoryInterface $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }
    public function index()
    {
        if (Gate::allows('show_listEvent')) {

            return view('admin.eventViews.listEvent', ['events' => $this->eventRepo->getAll()]);
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return view('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('add_Event')) {

            return view('admin.eventViews.addEvent');
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->eventRepo->storeEvent($input);

        return redirect()->route('admin.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showConfirmtEvent(Request $request)
    {
        /*$image = $request->file('file');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
       
        Storage::disk('public')->put($new_name, file_get_contents($image));*/
        $image_parts = explode(";base64,", $request->filetmp);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        // $file = $folderPath . uniqid() . '.png';
        $filename = time() . '.' . $image_type;
        Storage::disk('public')->put($filename, $image_base64);
        return response()->json([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $filename,
        ]);
    }

    public function showForm()
    {
        return view('admin.eventViews.confirmEvent');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('edit_Event')) {


            return view('admin.eventViews.editEvent', ['event' => $this->eventRepo->edit($id)]);
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return redirect()->back();
        }
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
        $input = $request->all();
        $this->eventRepo->updateEvent($input, $id);

        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('remove_Event')) {
            $this->eventRepo->destroy($id);
            return redirect()->route('admin.events.index');
        } else {
            Alert::warning('Warning Title', 'Ban khong co quyen truy cap vao day');


            return redirect()->back();
        }
    }

    public function showimportEvent()
    {
        return view('admin.eventViews.importEvent');
    }


    public function importEvent(Request $request)
    {
        Excel::import(new EventsImport, $request->file);

        return view('admin.eventViews.listEvent', ['listEvents' => $this->eventRepo->getAll()]);
    }
}
