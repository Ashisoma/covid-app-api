<?php

namespace controllers\utils;

use models\Facility;
use models\NumberClient;

class NumberProvider
{

    public static function generatePatientNumber($facilityCode)
    {
        try {
            $numberClient = NumberClient::where('prefix', $facilityCode)->first();
            if ($numberClient == null) {
                $numberClient = self::createFacilityNumberClient($facilityCode);
            }
            if ($numberClient == null) throw new \Exception("Number client not found. ", 1);
            $patientNo = $numberClient->prefix;
            $nextIndex = $numberClient->lastIndex + 1;
            $numberClient->lastIndex = $nextIndex;
            while (strlen($nextIndex) < $numberClient->minLength) {
                $nextIndex = "0".$nextIndex;
            }
            $numberClient->save();
            $patientNo .= $numberClient->separator;
            $patientNo .= $nextIndex;
            return $patientNo;
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            return "";
        }
    }

    public static function createFacilityNumberClient($facilityCode)
    {
        $facility = Facility::where('mflCode', $facilityCode)->first();
        if($facility == null) return null;
        $numberClient = NumberClient::create([
            'name' => $facility->name . " Number client. ",
            'prefix' => $facility->mflCode,
            'separator' => '',
            'minLength' => 5,
            'lastIndex' => 0
        ]);
        return $numberClient;
    }
}
