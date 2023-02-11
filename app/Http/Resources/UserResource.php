<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "fk_access_level" => $this->fk_access_level,
            "positions" => $this->formatPositions()
        ];
    }

    private function formatPositions()
    {
        $positions = [];
        if ($this->employee && $this->employee->positions) {
            foreach ($this->employee->positions as $employeePosition) {
                array_push($positions, $employeePosition->position->name);
            }
        }

        return $positions;
    }
}
