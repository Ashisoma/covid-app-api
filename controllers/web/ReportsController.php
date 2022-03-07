<?php

namespace controllers\web;

use controllers\utils\Utility;
use Illuminate\Database\Capsule\Manager as DB;

class ReportsController
{

    public function __construct()
    {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public function generateCovidReportData($startDate, $endDate)
    {
        // TODO filter later
        $query = "SELECT A.*, CONCAT(B.firstName, ' ', B.secondName, ' ', B.surname) AS 'name', B.gender, B.dob, B.occupation, C.name AS 'countyOfResidence', D.name AS 'subCounty',
        B.citizenship   FROM patient_screening A LEFT JOIN patients B ON A.patient_id = B.id
       LEFT JOIN counties C ON C.code = B.county LEFT JOIN sub_counties D ON D.id = B.subCounty";
        try {
            $results = DB::select($query);
            $data = [];
            foreach($results as $result){
                $datum['name'] = $result->name;
                $datum['gender'] = $result->gender;
                $datum['occupation'] = $result->occupation;
                $datum['age'] = Utility::getAge($result->dob);
                $datum['countyOfResidence'] = $result->countyOfResidence;
                $datum['subCounty'] = $result->subCounty;
                $datum['citizenship'] = $result->citizenship;
                $datum['cough'] = $result->cough;
                $datum['fever_history'] = $result->fever_history;
                $datum['breathing_difficulty'] = $result->breathing_difficulty;
                array_push($data, $datum);
            }
            $headers = ["Name", "Age", "Sex", "Occupation", "Nationality", "County Of Residence", "Sub-County Of Residence", "Cough", "Fever", "Difficulty In Breathing"];
            $attributes = ["name", "age", "gender", "occupation", "citizenship", "countyOfResidence", "subCounty", "cough", "fever_history", "breathing_difficulty"];
            $fileName = "covid_data_report_";
            $fileName .= date("Y-m-d");
            $fileName .= ".xlsx";
            Utility::buildExcel($fileName, $headers, $attributes, $data);
            return $data;
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            return [];
        }
    }


}
