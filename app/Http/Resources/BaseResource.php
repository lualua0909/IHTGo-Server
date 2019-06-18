<?php

namespace App\Http\Resources;

use App\Helpers\HttpCode;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class BaseResource extends Resource
{
    public function with($request)
    {
        return [
            'status'  => HttpCode::SUCCESS,
            'error_code' => HttpCode::CODE_SUCCESS,
        ];
    }

    /**
     * @param string $fromFormat
     * @param $time
     * @param string $toFormat
     * @return string
     */
    protected function convertDateToFormat($fromFormat='Y-m-d H:i:s', $time, $toFormat='d/m/Y H:i:s')
    {
        return Carbon::createFromFormat($fromFormat, $time)->format($toFormat);
    }

    /**
     * @param $images
     * @return array
     */
    protected function getImage($images)
    {
        $result = [];
        foreach ($images as $i){
            array_push($result, [
                    'full' => route('api.image.show', $i->id),
                    'thumbnail' => route('api.image.show', ['id' => $i->id, 'type' => $i->type])
                ]);
        }
        return $result;
    }
}
