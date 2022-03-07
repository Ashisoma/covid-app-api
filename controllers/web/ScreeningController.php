<?php

namespace controllers\web;

use controllers\utils\Utility;
use models\PatientScreening;

class ScreeningController{

    public function __construct() {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public function savePatientScreening($screeningData){
        $params = ['patient_id', 'fever_history', 'general_weakness', 'cough', 'sore_throat', 'runny_nose',
         'weight_loss', 'night_sweats', 'loss_of_taste', 'loss_of_smell', 'breathing_difficulty', 'diarrhoea', 'headache',
          'irritability', 'confusion', 'nausea', 'shortness_of_breath', 'abdominal_pain', 'chest_pain', 'joint_pain', 'muscle_pain'];
        try{
            $missing = Utility::checkMissingAttributes($screeningData, $params);
            if(sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if($id != ''){
                $screening = PatientScreening::findOrFail($id);
                $screening->fever_history = $screeningData['fever_history'];
                $screening->chills = $screeningData['chills'];
                $screening->general_weakness = $screeningData['general_weakness'];
                $screening->cough = $screeningData['cough'];
                $screening->sore_throat = $screeningData['sore_throat'];
                $screening->runny_nose = $screeningData['runny_nose'];
                $screening->weight_loss = $screeningData['weight_loss'];
                $screening->night_sweats = $screeningData['night_sweats'];
                $screening->loss_of_taste = $screeningData['loss_of_taste'];
                $screening->loss_of_smell = $screeningData['loss_of_smell'];
                $screening->breathing_difficulty = $screeningData['breathing_difficulty'];
                $screening->diarrhoea = $screeningData['diarrhoea'];
                $screening->headache = $screeningData['headache'];
                $screening->irritability = $screeningData['irritability'];
                $screening->confusion = $screeningData['confusion'];
                $screening->nausea = $screeningData['nausea'];
                $screening->vomiting = $screeningData['vomiting'];
                $screening->abdominal_pain = $screeningData['abdominal_pain'];
                $screening->chest_pain = $screeningData['chest_pain'];
                $screening->joint_pain = $screeningData['joint_pain'];
                $screening->muscle_pain = $screeningData['muscle_pain'];
                $screening->save();
            } else {
                PatientScreening::create([
                    'patient_id' => $screeningData['patient_id'],
                    'fever_history' => $screeningData['fever_history'],
                    'chills' => $screeningData['chills'],
                    'general_weakness' => $screeningData['general_weakness'],
                    'cough' => $screeningData['cough'],
                    'sore_throat' => $screeningData['sore_throat'],
                    'runny_nose' => $screeningData['runny_nose'],
                    'weight_loss' => $screeningData['weight_loss'],
                    'night_sweats' => $screeningData['night_sweats'],
                    'loss_of_taste' => $screeningData['loss_of_taste'],
                    'loss_of_smell' => $screeningData['loss_of_smell'],
                    'breathing_difficulty' => $screeningData['breathing_difficulty'],
                    'diarrhoea' => $screeningData['diarrhoea'],
                    'headache' => $screeningData['headache'],
                    'irritability' => $screeningData['irritability'],
                    'confusion' => $screeningData['confusion'],
                    'nausea' => $screeningData['nausea'],
                    'vomiting' => $screeningData['vomiting'],
                    'abdominal_pain' => $screeningData['abdominal_pain'],
                    'chest_pain' => $screeningData['chest_pain'],
                    'joint_pain' => $screeningData['joint_pain'],
                    'muscle_pain' => $screeningData['muscle_pain'],
                    'screened_by' => $this->user->id,
                    'date_screened' => date('Y-m-d'),
                ]);
            }
        } catch(\Throwable $th){
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
        
    }
}
