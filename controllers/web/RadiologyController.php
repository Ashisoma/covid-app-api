<?php

use controllers\utils\Utility;
use models\RadiologyRequest;

class RadiologyController {

    public function __construct() {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public function saveRadRequest($requestData) {
        $params = ['date_requested', 'test_type', 'patient_id', 'date_done', 'results', 'comments'];
        try{

            $missing = Utility::checkMissingAttributes($requestData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($patientData['id']) && $patientData['id'] != '') $id = $patientData['id'];
            $files = Utility::uploadFiles();
            if($files == null) throw new \Exception("Unable to upload files... check above");
            if($id == ''){
                RadiologyRequest::create([
                    'date_requested' => $requestData['date_requested'],
                    'patient_id' => $requestData['patient_id'],
                    'test_type' => $requestData['test_type'],
                    'date_done' => $requestData['date_done'],
                    'results' => $requestData['results'],
                    'comments' => $requestData['comments'],
                    'files' => $files,
                    'submitted_by' => $this->user->id
                ]);
            } else {
                $radRequest = RadiologyRequest::findOrFail($id);
                $radRequest->date_requested = $requestData['date_requested'];
                $radRequest->test_type = $requestData['test_type'];
                $radRequest->date_done = $requestData['date_done'];
                $radRequest->results = $requestData['results'];
                $radRequest->comments = $requestData['comments'];
                $radRequest->file = $requestData['file'];
                $radRequest->save();
            }
        } catch(\Throwable $th){
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
        }
    }

}