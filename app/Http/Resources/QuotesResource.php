<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
            return [
                'id' => $this->id,
                'student_id'=>$this->student_id,
                'user_id'=>$this->user_id,
                'username'=>$this->user->name,
                'date' => $this->date,
                'affair' => $this->affair,
                'grade' => $this->students->grade,
            ];
       
    }
}
