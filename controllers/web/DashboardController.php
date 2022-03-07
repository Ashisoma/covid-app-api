<?php

namespace controllers\web;

use controllers\utils\Utility;
use models\County;
use models\PatientScreening;
use models\SubCounty;

class DashboardController
{

    public function __construct()
    {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public function getDashboardData()
    {
        //get screening
        try {
            //TODO filter later
            $facilityController = new FacilityController();
            $labController = new LabController();
            $dashboardData = [];
            $dashboardData['screenings'] = PatientScreening::all();
            $dashboardData['counties'] = $this->getCounties();
            $dashboardData['facilities'] = $facilityController->getFacilities();
            $dashboardData['labRequests'] = $labController->getLabRequests();
            echo json_encode($dashboardData);
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    private function getCounties()
    {
        $counties = County::all();
        foreach ($counties as $county) {
            $county['subcounties'] = SubCounty::where('county_code', $county->code)->get();
        }
        return $counties;
    }
    
}
