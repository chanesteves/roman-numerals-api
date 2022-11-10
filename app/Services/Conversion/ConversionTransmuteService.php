<?php

namespace App\Services\Conversion;

use Exception;
use Log;

use App\Models\Conversion;

use App\Services\RomanNumeralConverter;
use App\Http\Resources\ConversionResource;

class ConversionTransmuteService
{
    const SOURCE = 'integer';
    const TARGET = 'roman';
    protected $params;

    /**
     * Add constructor.
     */
    public function __construct($params) {
        $this->params = $params;
    }

    public function getResult() {
        $source = $this->params['source'] ?? self::SOURCE;
        $target = $this->params['target'] ?? self::TARGET;
        $input = $this->params['input'] ?? '';

        try {
            Log::debug("Checking if the conversion has already been performed before... ");

            $conversion = Conversion::where([
                'source'    => $source,
                'target'    => $target,
                'input'     => $input
            ])->first();
            if ($conversion) {
                Log::debug("Found!\n");

                $usage = $conversion->usage;
                $conversion->usage = ++$usage;
                $conversion->save();

                return new ConversionResource($conversion);
            }

            Log::debug("Not found!\n");

            if ($source === 'integer' && $target == 'roman') {
                if (!is_int($input)) {
                    return [
                        'error' => "Invalid data type of input."
                    ];
                }

                $input = intval($input);
                if ($input < 1 || $input > 3999) {
                    return [
                        'error' => "Invalid range of input. Only integers ranging from 1 to 3,999 are currently supported."
                    ];
                }

                Log::debug("Performing integer to roman numeral conversion... ");

                $converter = new RomanNumeralConverter();
                $output = $converter->convertInteger($input);

                Log::debug("Done!\n");
                Log::debug("Storing the conversion to the database... ");

                $conversion = Conversion::create([
                    'source'    => $source,
                    'target'    => $target,
                    'input'     => strval($input),
                    'output'    => $output,
                    'usage'     => 1
                ]);

                Log::debug("Done!\n");

                return new ConversionResource($conversion);
            } else {
                $error = "Invalid conversion operation. Only 'integer to roman numeral' conversion is currently supported.";
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
