<?php

namespace App\Http\Controllers\Api;

use App\Models\Conversion;

use App\Services\Conversion\ConversionTransmuteService;
use App\Services\Conversion\ConversionListService;
use App\Services\RomanNumeralConverter;
use App\Http\Resources\ConversionResource;
use App\Http\Requests\ListConversionRequest;
use App\Http\Requests\TransmuteConversionRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    /**
     * Do conversions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transmute(TransmuteConversionRequest $request)
    {
        return (new ConversionTransmuteService($request->all()))->getResult();
    }

    /**
     * List conversions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(ListConversionRequest $request)
    {
        return (new ConversionListService($request->all()))->getResult();
    }
}
