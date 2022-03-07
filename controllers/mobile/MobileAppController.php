<?php

namespace controllers\mobile;

use controllers\utils\Utility;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Database\Capsule\Manager as DB;
use models\Contact;
use models\ContactTracing;
use models\LabRequest;
use models\Patient;
use models\PatientScreening;
use models\PatientTriage;
use models\RadiologyRequest;
use models\SessionManager;
use models\User;
use models\UserCategory;
use models\PatientHistory;
use Throwable;

class MobileAppController
{
    public function login($userData)
    {
        $params = ['phone', 'password'];
        try {
            $missing = Utility::checkMissingAttributes($userData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing));
            $phone = $userData['phone'];
            $password = $userData['password'];
            $user = User::where('phone', $phone)->where('active', 1)->firstOrFail();
            if (password_verify($password, $user->password)) {
                $userCategory = UserCategory::findOrFail($user->category);
                if (!in_array(PERM_ACCESS_APP, json_decode($userCategory->permissions))) {
                    throw new Exception("User not allowed. Contact system admin for support.",
                        FORBIDDEN_RESPONSE_CODE);
                }
                $privateKey = file_get_contents(__DIR__ . '/../../mykey.pem');
                $issuer_claim = 'Tiba-tekelezi';
                $issuedat_claim = time();
                $expire_claim = $issuedat_claim + TOKEN_TIME;
                $token = array(
                    "iss" => $issuer_claim,
                    "iat" => $issuedat_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "id" => $user->id
                    ));
                $user->last_login = date("Y:m:d h:i:s", time());
                $user->save();
                $user['userCategory'] = $userCategory->name;

                $jwt = JWT::encode($token, $privateKey, 'RS256');
                $activesessions = SessionManager::where('userID', $user->id)->where('active', 1)->get();
                if (sizeof($activesessions) > 0) {
                    foreach ($activesessions as $activesession) {
                        $activesession->active = 0;
                        $activesession->save();
                    }
                }
                SessionManager::create([
                    'userID' => $user->id,
                    'jwt' => $jwt,
                    'issuedat' => $issuedat_claim,
                    'expires_at' => $expire_claim
                ]);
                $user['token'] = $jwt;
                $user['token_expires_at'] = $expire_claim;
                echo json_encode($user);
            } else throw new Exception("Invalid password", PRECONDITION_FAILED_ERROR_CODE);
        } catch (Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
        }
    }

    public function register($userData)
    {
        $params = ['phone', 'password'];
        try {
            $missing = Utility::checkMissingAttributes($userData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing));
            $phone = $userData['phone'];
            $password = $userData['password'];
            throw_if(strlen($phone) < 10, new Exception("invalid phone number. " . $phone,
                INVALID_DATA_RESPONSE_CODE));
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $user = User::where('phone', $phone)->where('active', 0)->firstOrFail();
            $user->password = $hashedpassword;
            $user->active = 1;
            $user->save();

            echo json_encode(User::all());
        } catch (Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
        }
    }

    public function getPatients($mflCode)
    {
        try {
            $patients = Patient::where('facility', $mflCode)->get();

            foreach ($patients as $patient) {
                $patient['contacts'] = $this->getPatientContacts($patient->id);
            }

            echo json_encode($patients);
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function savePatient($patientData) {
        $params = ['firstName', 'secondName', 'surname', 'facility', 'nationalID', 'guardianID', 'guardianName',
            'phone', 'citizenship', 'gender', 'department', 'occupation', 'maritalStatus', 'educationLevel', 'dob', 'alive',
            'caseLocation', 'investigatingFacility', 'county', 'subCounty', 'nokName', 'nokPhone'];
        try {
            $missing = Utility::checkMissingAttributes($patientData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($patientData['id']) && $patientData['id'] != '') $id = $patientData['id'];
            if ($id != '') {
                $patient = Patient::findOrFail($id);
                $patient->firstName = $patientData['firstName'];
                $patient->secondName = $patientData['secondName'];
                $patient->surname = $patientData['surname'];
                $patient->facility = $patientData['facility'];
                $patient->department = $patientData['department'];
                $patient->nationalID = $patientData['nationalID'];
                $patient->guardianID = $patientData['guardianID'];
                $patient->guardianName = $patientData['guardianName'];
                $patient->phone = $patientData['phone'];
                $patient->citizenship = $patientData['citizenship'];
                $patient->gender = $patientData['gender'];
                $patient->occupation = $patientData['occupation'];
                $patient->maritalStatus = $patientData['maritalStatus'];
                $patient->educationLevel = $patientData['educationLevel'];
                $patient->dob = $patientData['dob'];
                $patient->alive = $patientData['alive'];
                $patient->caseLocation = $patientData['caseLocation'];
                $patient->investigatingFacility = $patientData['investigatingFacility'];
                $patient->county = $patientData['county'];
                $patient->subCounty = $patientData['subCounty'];
                $patient->nokName = $patientData['nokName'];
                $patient->nokPhone = $patientData['nokPhone'];
                $patient->save();
            } else {
                $patient = Patient::create([
                    'firstName' => $patientData['firstName'],
                    'secondName' => $patientData['secondName'],
                    'surname' => $patientData['surname'],
                    'facility' => $patientData['facility'],
                    'department' => $patientData['department'],
                    'nationalID' => $patientData['nationalID'],
                    'guardianID' => $patientData['guardianID'],
                    'guardianName' => $patientData['guardianName'],
                    'phone' => $patientData['phone'],
                    'citizenship' => $patientData['citizenship'],
                    'gender' => $patientData['gender'],
                    'occupation' => $patientData['occupation'],
                    'maritalStatus' => $patientData['maritalStatus'],
                    'educationLevel' => $patientData['educationLevel'],
                    'dob' => $patientData['dob'],
                    'alive' => $patientData['alive'],
                    'caseLocation' => $patientData['caseLocation'],
                    'investigatingFacility' => $patientData['investigatingFacility'],
                    'county' => $patientData['county'],
                    'subCounty' => $patientData['subCounty'],
                    'nokName' => $patientData['nokName'],
                    'nokPhone' => $patientData['nokPhone'],
                ]);
            }
            echo json_encode($patient);
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function saveTriage($triageData)
    {
        $params = ['temperature', 'weight', 'height', 'zscore', 'cough', 'difficulty_in_breathing',
            'weight_loss', 'patient_id', 'filled_by'];
        try {
            $missing = Utility::checkMissingAttributes($triageData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing));

            $triage = PatientTriage::create([
                'temperature' => $triageData['temperature'],
                'weight' => $triageData['weight'],
                'height' => $triageData['height'],
                'spo2' => $triageData['spo2'],
                'zscore' => $triageData['zscore'],
                'cough' => $triageData['cough'],
                'difficulty_in_breathing' => $triageData['difficulty_in_breathing'],
                'weight_loss' => $triageData['weight_loss'],
                'patient_id' => $triageData['patient_id'],
                'filled_by' => $triageData['filled_by'],
                'triage_time' => date("Y:m:d h:i:s", time()),
            ]);
            echo json_encode($triage);
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function saveScreeningForm($screeningData)
    {
        $params = ['patient_id', 'screened_by', 'fever_history', 'general_weakness', 'cough', 'sore_throat',
            'runny_nose', 'weight_loss', 'night_sweats', 'loss_of_taste', 'loss_of_smell', 'breathing_difficulty',
            'diarrhoea', 'headache', 'irritability', 'nausea', 'shortness_of_breath', 'pain'];
        try {
            $missing = Utility::checkMissingAttributes($screeningData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing),
                PRECONDITION_FAILED_ERROR_CODE);

            $screening = PatientScreening::create([
                'patient_id' => $screeningData['patient_id'],
                'screened_by' => $screeningData['screened_by'],
                'fever_history' => $screeningData['fever_history'],
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
                'nausea' => $screeningData['nausea'],
                'shortness_of_breath' => $screeningData['shortness_of_breath'],
                'pain' => $screeningData['pain'],
            ]);
            echo json_encode($screening);
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function getPatientContacts($patientID)
    {
        $contacts = Contact::where("patient_id", $patientID)->get();
/*
        foreach ($contacts as $contact) {
            $contact['traced'] =

        }*/

        return $contacts;
    }

    // get the routing for the other data to be pulled by the app 
    public function getPatientHistory($patientID)
    {
        // $history = PatientHistory::where("patient_id", $patientID)->get();
        $lastScreening = PatientTriage::where("patient_id", $patientID)->orderBy('id', 'DESC')->first();
/*
        foreach ($contacts as $contact) {
            $contact['traced'] =

        }*/

        return $lastScreening;
    }
    public function getRadiologyData($patientID)
    {
        $lastRadioloy = RadiologyRequest::where("patient_id",$patientID)->orderBy('id', 'DESC')->first();
        return $lastRadioloy;
    }

    public function getLabRequests($patientID)
    {
        $lastLabRequests = LabRequest::where("patient_id",$patientID)->orderBy('id', 'DESC')->first();
        return $lastLabRequests;
    }

    public function savePatientContact($contactData)
    {
        $params = ['firstName', 'middleName', 'surname', "phoneNumber", "patient_id"];
        try {
            $missing = Utility::checkMissingAttributes($contactData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing),
                PRECONDITION_FAILED_ERROR_CODE);

            Contact::create([
                "firstName" => $contactData['firstName'],
                "middleName" => $contactData['middleName'],
                "surname" => $contactData['surname'],
                "phoneNumber" => $contactData['phoneNumber'],
                "patient_id" => $contactData['patient_id']
            ]);

            echo json_encode($this->getPatientContacts($contactData['patient_id']));
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function saveContactTracingForm($tracingData)
    {
        $params = ['contact_id', 'contactTraced', "reported_by"];
        try {
            DB::beginTransaction();
            $missing = Utility::checkMissingAttributes($tracingData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing),
                PRECONDITION_FAILED_ERROR_CODE);

            ContactTracing::create([
                'contact_id' => $tracingData['contact_id'],
                'county' => $tracingData['county'],
                'subcounty' => $tracingData['subcounty'],
                'contactTraced' => $tracingData['contactTraced'],
                'tracingDate' => $tracingData['tracingDate'],
                'reported_by' => $tracingData['reported_by'],
                'contactTested' => $tracingData['contactTested'],
                'testingDate' => $tracingData['testingDate'],
                'testOutcome' => $tracingData['testOutcome']
            ]);

            $contact = Contact::findOrFail($tracingData['contact_id']);

            if ($tracingData['contactTested'] == "Yes" && $tracingData['testOutcome'] != "") {
                $contact->active = 0;
                $contact->save();
            }

            DB::commit();
            echo json_encode($contact);
        } catch (\Throwable $th) {
            DB::rollback();
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function savePatientHistory($data)
    {

    }

    public function saveLabRequest($labData)
    {
        $params = ['patient_id', 'investigator', 'specimen_collected', 'reason_not_collected', 'test_type',
            'specimen_type', 'date_collected', 'date_sent_to_lab'];
        try {
            $missing = Utility::checkMissingAttributes($labData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing),
                PRECONDITION_FAILED_ERROR_CODE);

            $lab = LabRequest::create([
                'patient_id' => $labData['patient_id'],
                'investigator' => $labData['investigator'],
                'specimen_collected' => $labData['specimen_collected'],
                'reason_not_collected' => $labData['reason_not_collected'],
                'test_type' => $labData['test_type'],
                'specimen_type' => $labData['specimen_type'],
                'date_collected' => $labData['date_collected'],
                'date_sent_to_lab' => $labData['date_sent_to_lab']
            ]);
            echo json_encode($lab);
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function saveRadiologyRequest($radiologyData)
    {
        $params = ['date_requested', 'patient_id', 'date_done', 'test_type', 'results', 'comments', 'submitted_by'];
        try {
            $missing = Utility::checkMissingAttributes($radiologyData, $params);
            if (sizeof($missing) > 0) throw new Exception('Missing attributes: ' . json_encode($missing),
                PRECONDITION_FAILED_ERROR_CODE);

            $radiology = RadiologyRequest::create([
                'patient_id' => $radiologyData['patient_id'],
                'date_requested' => $radiologyData['date_requested'],
                'date_done' => $radiologyData['date_done'],
                'test_type' => $radiologyData['test_type'],
                'results' => $radiologyData['results'],
                'comments' => $radiologyData['comments'],
                'submitted_by' => $radiologyData['submitted_by']
            ]);
            echo json_encode($radiology);
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function searchPatient($searchString)
    {
        try {
            $query = "SELECT * FROM patients WHERE phone LIKE '$searchString%' OR nationalID LIKE '$searchString%'
                              OR guardianID LIKE '$searchString%'";
            $clients = DB::select($query);

            echo json_encode($clients);
        } catch (\Throwable $e) {
            echo myJsonResponse($e->getCode(), $e->getMessage());
            logError($e->getCode(), $e->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

}
