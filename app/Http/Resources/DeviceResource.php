<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Device;

class DeviceResource extends JsonResource
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
            'id' => $this->id,
            'model' => $this->model,
            'brand' => $this->brand,
            'release_date' => $this->release_date,
            'os' => $this->os,
            'is_new' => $this->is_new,
            //'received_datatime' => $this->received_datatime,
            //'created_datetime' => $this->created_datetime,
            //'update_datetime' => $this->update_datetime
        ];
    }
}
