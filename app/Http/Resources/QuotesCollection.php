<?php

namespace App\Http\Resources;

 
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuotesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($row, $key) {
           
            return [
                'id' => $row->id,
                'student'=>$row->students,
                'user'=>$row->user,
                'date' => Carbon::parse($row->date)->format('d-m-Y'),
                'affair' => $row->affair,
            ];
        });
    }
}
