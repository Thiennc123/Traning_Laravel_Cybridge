<?php

namespace App\Repositories\EventRepositories;

use App\Repositories\EventRepositories\EventRepositoryInterface;

use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\Storage;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Event::class;
    }

    public function storeEvent(array $request)
    {

        $event = new $this->model;
        /* if ($request['file']) {

            $file = $request['file'];




            $extension = $file->getClientOriginalExtension();
            $filename = rand() . '.' . $extension;


            Storage::disk('public')->put($filename, file_get_contents($file));
            $url = Storage::url($filename);
            $event->image = $url;
        }*/

        Storage::move('public/tmp/' . $_COOKIE['image'], 'public/images/' . $_COOKIE['image']);


        $event->name = $_COOKIE['name'];
        $event->content = $_COOKIE['content'];
        $event->image = '/storage/images/' . $_COOKIE['image'];
        $event->status = "public";
        $event->admin_id = Auth()->guard('admin')->id();
        $event->save();
    }

    public function updateEvent(array $request, $id)
    {
        if ($request['file']) {

            $file = $request['file'];




            $extension = $file->getClientOriginalExtension();
            $filename = rand() . '.' . $extension;


            Storage::disk('public')->put($filename, file_get_contents($file));
            $url = Storage::url($filename);
        }
        $this->model::find($id)->update([
            'name' => $request['name'],
            'content' => $request['content'],
            'status' => "public",
            'admin_id' => Auth()->guard('admin')->id(),
            'image' => $url,
        ]);
    }
}
