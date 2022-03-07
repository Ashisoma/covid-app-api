<?php

namespace controllers\web;

use controllers\utils\Utility;
use Illuminate\Database\Capsule\Manager as DB;
use models\LabRequest;

/**
 * @author Joseph Kimani
 *
 * */
class LabController{

    public function __construct() {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public function saveLabRequest($requestData){
        $params = [
            'patient_id','specimen_collected', 'reason_not_collected', 'testTypes', 'date_collected', 'date_sent_to_lab',
        ];
        try{
            $missing = Utility::checkMissingAttributes($requestData, $params);
            if(sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($requestData['id']) && $requestData['id'] != '') $id = $requestData['id'];
            $testTypes = $requestData['testTypes'];
            DB::beginTransaction();
            foreach ($testTypes as $testType){
                LabRequest::create([
                    'patient_id' => $requestData['patient_id'],
                    'specimen_collected' => $requestData['specimen_collected'],
                    'reason_not_collected' => $requestData['reason_not_collected'],
                    'test_type' => $testType['name'],
                    'specimen_type' => $testType['specimen_type'],
                    'date_collected' => $requestData['date_collected']  == '' ? null : $requestData['date_collected'],
                    'date_sent_to_lab' => $requestData['date_sent_to_lab'] == '' ? null : $requestData['date_sent_to_lab'],
                ]);
            }
            /*if($id == ''){
                LabRequest::create([
                    'patient_id' => $requestData['patient_id'],
                    'specimen_collected' => $requestData['specimen_collected'],
                    'reason_not_collected' => $requestData['reason_not_collected'],
                    'specimen_type' => $requestData['specimen_type'],
                    'specimen_type_other' => $requestData['specimen_type_other'],
                    'test_type' => $requestData['test_type'],
                    'date_collected' => $requestData['date_collected']  == '' ? null : $requestData['date_collected'],
                    'date_sent_to_lab' => $requestData['date_sent_to_lab'] == '' ? null : $requestData['date_sent_to_lab'],
                    'date_received_in_lab' => $requestData['date_received_in_lab'] == '' ? null : $requestData['date_received_in_lab'],
                    'confirming_lab' => $requestData['confirming_lab'],
                    'assay_used' => $requestData['assay_used'],
                    'lab_result' => $requestData['lab_result'],
                    'sequencing_done' => $requestData['sequencing_done'],
                    'lab_confirmation_date' => $requestData['lab_confirmation_date'] == '' ? null : $requestData['lab_confirmation_date'],
                    'investigator' => $requestData['investigator'],
                ]);
            } else {
                $labRequest = LabRequest::findOrFail($id);
                $labRequest->specimen_collected = $requestData['specimen_collected'];
                $labRequest->reason_not_collected = $requestData['reason_not_collected'];
                $labRequest->specimen_type = $requestData['specimen_type'];
                $labRequest->specimen_type_other = $requestData['specimen_type_other'];
                $labRequest->test_type = $requestData['test_type'];
                $labRequest->date_collected = $requestData['date_collected'] == '' ? null : $requestData['date_collected'];
                $labRequest->date_sent_to_lab = $requestData['date_sent_to_lab'] == '' ? null : $requestData['date_sent_to_lab'];
                $labRequest->date_received_in_lab = $requestData['date_received_in_lab'] == '' ? null : $requestData['date_received_in_lab'];
                $labRequest->confirming_lab = $requestData['confirming_lab'];
                $labRequest->assay_used = $requestData['assay_used'];
                $labRequest->lab_result = $requestData['lab_result'];
                $labRequest->sequencing_done = $requestData['sequencing_done'];
                $labRequest->lab_confirmation_date = $requestData['lab_confirmation_date'] == '' ? null : $requestData['lab_confirmation_date'];
                $labRequest->investigator = $requestData['investigator'];
                $labRequest->save();
            }*/
            DB::commit();
        } catch(\Throwable $th){
            DB::rollBack();
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
            logError($th->getCode(), $th->getMessage());
        }
    }

    public function saveLabResults($requestData)
    {
        $params = ['id', 'date_received_in_lab', 'confirming_lab',
            'assay_used', 'lab_result', 'sequencing_done', 'lab_confirmation_date', 'investigator'];
        try{
            $missing = Utility::checkMissingAttributes($requestData, $params);
            if(sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = $requestData['id'];
            $labRequest = LabRequest::findOrFail($id);
            $labRequest->date_received_in_lab = $requestData['date_received_in_lab'] == '' ? null : $requestData['date_received_in_lab'];
            $labRequest->confirming_lab = $requestData['confirming_lab'];
            $labRequest->assay_used = $requestData['assay_used'];
            $labRequest->lab_result = $requestData['lab_result'];
            $labRequest->sequencing_done = $requestData['sequencing_done'];
            $labRequest->lab_confirmation_date = $requestData['lab_confirmation_date'] == '' ? null : $requestData['lab_confirmation_date'];
            $labRequest->investigator = $requestData['investigator'];
            $labRequest->save();
        } catch(\Throwable $th){
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
            logError($th->getCode(), $th->getMessage());
        }
    }

    public function getPatientLabRequests($patient_id){
        try{
            $labRequests = LabRequest::where('patient_id', $patient_id)->get();
            return $labRequests;
        } catch(\Throwable $th){
            logError($th->getCode(), $th->getMessage());
            return [];
        }
    }

    public function getLabRequests(){
        //TODO filter later
        $labRequests = LabRequest::all();
        return $labRequests;
    }

}
