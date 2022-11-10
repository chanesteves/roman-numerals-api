<?php

namespace App\Services\Conversion;

use Exception;
use Log;

use App\Models\Conversion;

use App\Http\Resources\ConversionResource;

class ConversionListService
{
    const RECENT_ELAPSED = 86400; // recently converted integers in the LAST 24 HOURS by default
    const POPULAR_LIMIT = 10; // TOP 10 converted integers by default
    protected $params;

    /**
     * Add constructor.
     */
    public function __construct($params) {
        $this->params = $params;
    }

    public function getResult() {
        try {
            $type = $this->params['type'] ?? null;
            if ($type == 'recent') {
                Log::debug("Listing the recently performed conversions... ");

                $elapsed = $this->params['elapsed'] ?? 0;
                $start_date = date('Y-m-d H:i:s', strtotime('-' . $elapsed . ' seconds'));
                $conversions = Conversion::where('updated_at', '>=', $start_date)->orderBy('updated_at', 'DESC')->get();

                Log::debug("Done!\n");

                return ConversionResource::collection($conversions);
            } elseif ($type == 'popular') {
                Log::debug("Listing the top conversions performed... ");

                $limit = $this->params['limit'] ?? self::POPULAR_LIMIT;
                $conversions = Conversion::where('usage', '>', 0)->orderBy('usage', 'DESC')->limit($limit)->get();

                Log::debug("Done!\n");

                return ConversionResource::collection($conversions);
            } else {
                $error = "Invalid list type. Only 'recent' and 'popular' are currently supported.";
                Log::error($error . "\n");

                return [
                    'error' => $error
                ];
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            Log::error($error . "\n");
            return [
                'error' => $error
            ];
        }
    }
}
