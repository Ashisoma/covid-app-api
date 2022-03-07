<?php

namespace controllers\web;

use controllers\utils\Utility;
use models\County;
use models\Facility;
use models\Project;
use models\SubCounty;

class FacilityController
{
    public function __construct()
    {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public function getFacilities()
    {
        $facilities = Facility::all();
        foreach ($facilities as $facility) {
            $projectData = Project::find($facility->project);
            $countyData = County::where('code', $facility->county)->first();
            $subcountyData = SubCounty::find($facility->subCounty);
            $facility['projectData'] = $projectData;
            $facility['countyData'] = $countyData;
            $facility['subcountyData'] = $subcountyData;
        }
        return $facilities;
    }

    public function getAllFacilities()
    {
        $facilities = Facility::all();
        foreach ($facilities as $facility) {
            $projectData = Project::find($facility->project);
            $countyData = County::where('code', $facility->county)->first();
            $subcountyData = SubCounty::find($facility->subCounty);
            $facility['projectData'] = $projectData;
            $facility['countyData'] = $countyData;
            $facility['subcountyData'] = $subcountyData;
        }
        return $facilities;
    }

    public function saveFacility($facilityData)
    {
        $params = ['mflCode', 'name', 'county', 'subCounty', 'project'];
        try {
            $missing = Utility::checkMissingAttributes($facilityData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($facilityData['id'])) $id = $facilityData['id'];
            $mfl_code = $facilityData['mflCode'];
            $name = $facilityData['name'];
            $county = $facilityData['county'];
            $subcounty = $facilityData['subCounty'];
            if ($id != NULL && $id != '') {
                $facility = Facility::findOrFail($id);
                $facility->name = $name;
                $facility->county = $county;
                $facility->subcounty = $subcounty;
                $facility->mflCode = $mfl_code;
                $facility->project = $facilityData['project'];
                $facility->save();
            } else {
                $facility = Facility::create([
                    "name" => $name,
                    "county" => $county,
                    "subCounty" => $subcounty,
                    "mflCode" => $mfl_code,
                    "project" => $facilityData['project']
                ]);
            }
            echo json_encode($this->getFacilities());
        } catch (\Exception $e) {
            Utility::logError($e->getCode(), $e->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }
}
