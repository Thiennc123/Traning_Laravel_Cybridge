<?php

namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EventsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Event([
            'name' => $row['name'],
            'content' => $row['content'],
            'status' => $row['status'],
            'user_id' => auth()->id(),
            'image' => '',
        ]);
    }
}
