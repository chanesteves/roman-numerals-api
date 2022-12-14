<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversionResource extends JsonResource
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
            'source'        => $this->source,
            'target'        => $this->target,
            'input'         => $this->input,
            'output'        => $this->output,
            'usage'         => $this->usage,
            'updated_at'    => $this->updated_at,
        ];
    }
}
