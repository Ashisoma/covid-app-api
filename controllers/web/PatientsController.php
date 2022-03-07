<?php

namespace controllers\web;

use controllers\utils\Utility;
use models\Patient;
use Illuminate\Database\Capsule\Manager as DB;
use models\Contact;
use models\ContactTracing;
use models\County;
use models\CovidVaccine;
use models\Facility;
use models\LabRequest;
use models\PatientHistory;
use models\PatientLinkage;
use models\PatientManagement;
use models\PatientScreening;
use models\PatientTriage;
use models\RadiologyRequest;
use models\SubCounty;

class PatientsController
{
    public function __construct()
    {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public function savePatient($patientData)
    {
        $params = [
            'firstName', 'secondName', 'surname', 'facility', 'nationalID', 'guardianID', 'guardianName',
            'phone', 'occupation', 'citizenship', 'gender', 'maritalStatus', 'educationLevel', 'dob', 'alive',
            'caseLocation', 'county', 'subCounty', 'nokName', 'nokPhone', 'investigatingFacility', 'department', 'landmark'
        ];
        try {
            $missing = Utility::checkMissingAttributes($patientData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($patientData['id']) && $patientData['id'] != '') $id = $patientData['id'];
            if ($id != '') {
                $patient = Patient::findOrFail($id);
                $patient->firstName = trim($patientData['firstName']);
                $patient->secondName = trim($patientData['secondName']);
                $patient->surname = trim($patientData['surname']);
                $patient->facility = trim($patientData['facility']);
                $patient->nationalID = trim($patientData['nationalID']);
                $patient->guardianID = trim($patientData['guardianID']);
                $patient->guardianName = trim($patientData['guardianName']);
                $patient->phone = trim($patientData['phone']);
                $patient->occupation = trim($patientData['occupation']);
                $patient->citizenship = trim($patientData['citizenship']);
                $patient->gender = trim($patientData['gender']);
                $patient->maritalStatus = trim($patientData['maritalStatus']);
                $patient->educationLevel = trim($patientData['educationLevel']);
                $patient->dob = trim($patientData['dob']);
                $patient->alive = trim($patientData['alive']);
                $patient->caseLocation = trim($patientData['caseLocation']);
                $patient->county = trim($patientData['county']);
                $patient->subCounty = trim($patientData['subCounty']);
                $patient->nokName = trim($patientData['nokName']);
                $patient->nokPhone = trim($patientData['nokPhone']);
                $patient->landmark = trim($patientData['landmark']);
                $patient->department = trim($patientData['department']);
                $patient->investigatingFacility = trim($patientData['investigatingFacility']);
                $patient->save();
            } else {
                Patient::create([
                    'firstName' => trim($patientData['firstName']),
                    'secondName' => trim($patientData['secondName']),
                    'surname' => trim($patientData['surname']),
                    'facility' => trim($patientData['facility']),
                    'nationalID' => trim($patientData['nationalID']),
                    'guardianID' => trim($patientData['guardianID']),
                    'guardianName' => trim($patientData['guardianName']),
                    'phone' => trim($patientData['phone']),
                    'occupation' => trim($patientData['occupation']),
                    'citizenship' => trim($patientData['citizenship']),
                    'gender' => trim($patientData['gender']),
                    'maritalStatus' => trim($patientData['maritalStatus']),
                    'educationLevel' => trim($patientData['educationLevel']),
                    'dob' => trim($patientData['dob']),
                    'alive' => trim($patientData['alive']),
                    'caseLocation' => trim($patientData['caseLocation']),
                    'county' => trim($patientData['county']),
                    'subCounty' => trim($patientData['subCounty']),
                    'nokName' => trim($patientData['nokName']),
                    'nokPhone' => trim($patientData['nokPhone']),
                    'department' => trim($patientData['department']),
                    'landmark' => trim($patientData['landmark']),
                    'investigatingFacility' => trim($patientData['investigatingFacility']),
                ]);
            }
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function getPatients()
    {
    }

    public function searchPatient($searchString)
    {
        try {
            $searchString = trim($searchString);
            $query = "SELECT * FROM patients A WHERE A.nationalID LIKE '%" . $searchString . "%' OR A.phone LIKE '%" . $searchString . "%'";
            $patients = DB::select($query);
            foreach ($patients as $patient) {
                $facilityData = Facility::where('mflCode', $patient->facility)->firstOrFail();
                $patient->facilityData = $facilityData;
            }
            return $patients;
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            return [];
        }
    }

    public function saveTriageForm($triageData)
    {
        $params = [
            'temperature', 'weight', 'height', 'spo2', 'zscore', 'triage_time', 'patient_id'
        ];
        try {
            $missing = Utility::checkMissingAttributes($triageData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($triageData['id']) && $triageData['id'] != '') $id = $triageData['id'];
            if ($id == '') {
                PatientTriage::create([
                    'temperature' => trim($triageData['temperature']),
                    'weight' => trim($triageData['weight']),
                    'height' => trim($triageData['height']),
                    'spo2' => trim($triageData['spo2']),
                    'zscore' => trim($triageData['zscore']),
                    'triage_time' => trim($triageData['triage_time']),
                    'patient_id' => trim($triageData['patient_id']),
                    'filled_by' => $this->user->id
                ]);
            } else {
                $triage = PatientTriage::findOrFail($id);
                $triage->temperature = trim($triageData['temperature']);
                $triage->weight = trim($triageData['weight']);
                $triage->height = trim($triageData['height']);
                $triage->spo2 = trim($triageData['spo2']);
                $triage->zscore = trim($triageData['zscore']);
                $triage->save();
            }
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function saveContactTracing($tracingData)
    {
        $params = [
            'contact_id', 'county', 'subcounty', 'contactTraced',
            'tracingDate', 'tracerName', 'contactTested', 'testingDate', 'testOutcome'
        ];
        try {
            $missing = Utility::checkMissingAttributes($tracingData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($tracingData['id']) && $tracingData['id'] != '') $id = $tracingData['id'];
            $contact = Contact::findOrFail($tracingData['contact_id']);
            if ($id == '') {
                $tracing = ContactTracing::create([
                    'contact_id' => $tracingData['contact_id'],
                    'reported_by' => $this->user->id,
                    'county' => $tracingData['county'],
                    'subcounty' => $tracingData['subcounty'],
                    'contactTraced' => $tracingData['contactTraced'],
                    'tracingDate' => $tracingData['tracingDate'],
                    'tracerName' => $tracingData['tracerName'],
                    'contactTested' => $tracingData['contactTested'],
                    'testingDate' => $tracingData['testingDate'],
                    'testOutcome' => $tracingData['testOutcome']
                ]);
            } else {
                $tracing = ContactTracing::findOrFail($id);
                $tracing->tracerName = trim($tracingData['tracerName']);
                $tracing->county = $tracingData['county'];
                $tracing->subcounty = $tracingData['subcounty'];
                $tracing->contactTraced = $tracingData['contactTraced'];
                $tracing->tracingDate = $tracingData['tracingDate'];
                $tracing->contactTested = $tracingData['contactTested'];
                $tracing->testingDate = $tracingData['testingDate'];
                $tracing->testOutcome = $tracingData['testOutcome'];
                $tracing->save();
            }
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function saveContact($contactData)
    {
        $params = ["firstName", "middleName", "surname", "phoneNumber", "patient_id"];
        try {
            $missing = Utility::checkMissingAttributes($contactData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($contactData['id']) && $contactData['id'] != '') $id = $contactData['id'];
            if ($id == '') {
                Contact::create([
                    "firstName" => $contactData["firstName"],
                    "middleName" => $contactData["middleName"],
                    "surname" => $contactData["surname"],
                    "phoneNumber" => $contactData["phoneNumber"],
                    "patient_id" => $contactData["patient_id"],
                ]);
            } else {
                $contact = Contact::findOrFail($id);
                $contact->firstName = $contactData["firstName"];
                $contact->middleName = $contactData["middleName"];
                $contact->surname = $contactData["surname"];
                $contact->phoneNumber = $contactData["phoneNumber"];
                $contact->save();
            }
            echo json_encode($this->getActiveContacts($contactData['patient_id']));
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function getActiveContacts($patientId)
    {
        $contacts = Contact::where("patient_id", $patientId)->get();
        foreach ($contacts as $contact) {
            $tracings = ContactTracing::where("contact_id", $contact->id)->get();
            foreach ($tracings as $tracing) {
                $countyName = '';
                $subCountyName = '';
                $county = County::where("code", $tracing->county)->first();
                $subcounty = SubCounty::find($tracing->subcounty);
                if ($county != null) $countyName = $county->name;
                if ($subcounty != null) $subCountyName = $subcounty->name;
                $tracing['countyName'] = $countyName;
                $tracing['subCountyName'] = $subCountyName;
            }
            $contact['tracings'] = $tracings;
        }
        return $contacts;
    }

    public function savePatientManagement($managementData)
    {
        $params = [
            "patient_id", "symptoms_onset_date", "admitted_to_hospital", "date_admitted", "facility_code", "isolated", "date_isolated", "admitted_to_icu",
            "ventilated", "health_status", "outcome", "outcome_date", "symptoms_resolved", "date_resolved"
        ];
        try {
            $missing = Utility::checkMissingAttributes($managementData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($managementData['id']) && $managementData['id'] != '') $id = $managementData['id'];
            if ($id == '') {
                PatientManagement::create([
                    "patient_id" => $managementData['patient_id'],
                    "symptoms_onset_date" => $managementData['symptoms_onset_date'],
                    "admitted_to_hospital" => $managementData['admitted_to_hospital'],
                    "date_admitted" => $managementData['date_admitted'],
                    "facility_code" => $managementData['facility_code'],
                    "isolated" => $managementData['isolated'],
                    "date_isolated" => $managementData['date_isolated'] == '' ? null : $managementData['date_isolated'],
                    "admitted_to_icu" => $managementData['admitted_to_icu'],
                    "ventilated" => $managementData['ventilated'],
                    "health_status" => $managementData['health_status'],
                    "outcome" => $managementData['outcome'],
                    "outcome_date" => $managementData['outcome_date'] == '' ? null : $managementData['outcome_date'],
                    "symptoms_resolved" => $managementData['symptoms_resolved'],
                    "date_resolved" => $managementData['date_resolved'],
                ]);
            } else {
                $patientManagement = PatientManagement::findOrFail($id);
                $patientManagement->symptoms_onset_date = $managementData['symptoms_onset_date'];
                $patientManagement->admitted_to_hospital = $managementData['admitted_to_hospital'];
                $patientManagement->date_admitted = $managementData['date_admitted'];
                $patientManagement->facility_code = $managementData['facility_code'];
                $patientManagement->isolated = $managementData['isolated'];
                $patientManagement->date_isolated = $managementData['date_isolated'] == '' ? null : $managementData['date_isolated'];
                $patientManagement->admitted_to_icu = $managementData['admitted_to_icu'];
                $patientManagement->ventilated = $managementData['ventilated'];
                $patientManagement->health_status = $managementData['health_status'];
                $patientManagement->outcome = $managementData['outcome'];
                $patientManagement->outcome_date = $managementData['outcome_date'] == '' ? null : $managementData['outcome_date'];
                $patientManagement->symptoms_resolved = $managementData['symptoms_resolved'];
                $patientManagement->date_resolved = $managementData['date_resolved'];
            }
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function savePatientHistory($historyData){
        $params = ['patient_id', 'travelled', 'places_travelled', 'contact_with_infected', 'contact_setting', 'vaccinated', 'first_dose', 'first_dose_date',
        'second_dose', 'second_dose_date'];
        try {
            $missing = Utility::checkMissingAttributes($historyData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($historyData['id']) && $historyData['id'] != '') $id = $historyData['id'];
            if($id == ''){
                PatientHistory::create([
                    "patient_id" => $historyData['patient_id'],
                    'date_taken' => date("Y-m-d"),
                    'travelled' => $historyData['travelled'],
                    'places_travelled' => $historyData['places_travelled'],
                    'contact_with_infected' => $historyData['contact_with_infected'],
                    'contact_setting' => $historyData['contact_setting'],
                    'vaccinated' => $historyData['vaccinated'],
                    'first_dose' => $historyData['first_dose'],
                    'first_dose_date' => $historyData['first_dose_date'] == '' ? null : $historyData['first_dose_date'],
                    'second_dose' => $historyData['second_dose'],
                    'second_dose_date' => $historyData['second_dose_date'] == '' ? null : $historyData['second_dose_date'],
                ]);
            } else {
                $history = PatientHistory::findOrFail($id);
                $history->travelled = $historyData['travelled'];
                $history->places_travelled = $historyData['places_travelled'];
                $history->contact_with_infected = $historyData['contact_with_infected'];
                $history->contact_setting = $historyData['contact_setting'];
                $history->vaccinated = $historyData['vaccinated'];
                $history->first_dose = $historyData['first_dose'];
                $history->first_dose_date = $historyData['first_dose_date'] == '' ? null : $historyData['first_dose_date'];
                $history->second_dose = $historyData['second_dose'];
                $history->second_dose_date = $historyData['second_dose_date'] == '' ? null : $historyData['second_dose_date'];
                $history->save();
            }
        } catch(\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function getPatientManagementPageData($patientId){
        // Latest Screening
        // Latest Patient History
        // triage information-latest
        // patient Contacts
        //  last 5 lab requests 
        //  last 5 rad requests 

        try{
            $lastScreening = PatientScreening::orderBy('date_screened', 'DESC')->first();
            $lastHistory = PatientHistory::orderBy('date_taken', 'DESC')->first();
            if($lastHistory != null){
                $lastHistory['first_dose_name'] = '';
                $lastHistory['second_dose_name'] = '';
                if($lastHistory->first_dose != 0) {
                    $vaccine = CovidVaccine::findOrFail($lastHistory->first_dose);
                    $lastHistory['first_dose_name'] = $vaccine->name;
                }
                if($lastHistory->second_dose != 0) {
                    $vaccine = CovidVaccine::findOrFail($lastHistory->second_dose);
                    $lastHistory['second_dose_name'] = $vaccine->name;
                }
            }
            $lastTriage = PatientTriage::orderBy('triage_time', 'DESC')->first();
            $contacts = Contact::where('patient_id', $patientId)->orderBy('id', 'DESC')->offset(0)->limit(5)->get();
            $lastLabRequests = LabRequest::where('patient_id', $patientId)->orderBy('id', 'DESC')->offset(0)->limit(5)->get();
            $lastRadRequests = RadiologyRequest::where('patient_id', $patientId)->orderBy('id','DESC')->offset(0)->limit(5)->get();
            $data['lastScreening'] = $lastScreening;
            $data['lastTriage'] = $lastTriage;
            $data['lastHistory'] = $lastHistory;
            $data['contacts'] = $contacts;
            $data['lastLabRequests'] = $lastLabRequests;
            $data['lastRadRequests'] = $lastRadRequests;
            echo json_encode($data);
        } catch(\Throwable $th){
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public function linkPatient($linkageData){
        $params = ['patient_id', 'weight', 'height', 'linkage_date', 'linkage_dept', 'linkage_number', 'dot_manager', 'tb_type', 'eptb_subtype',
            'patient_type', 'culture', 'regiment', 'hiv_status'];
        try{
            $missing = Utility::checkMissingAttributes($linkageData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($linkageData['id']) && $linkageData['id'] != '') $id = $linkageData['id'];
            if($id == ''){
                PatientLinkage::create([
                    'patient_id' => $linkageData['patient_id'],
                    'weight' => $linkageData['weight'],
                    'height' => $linkageData['height'],
                    'linkage_date' => $linkageData['linkage_date'],
                    'linkage_dept' => $linkageData['linkage_dept'],
                    'linkage_number' => $linkageData['linkage_number'],
                    'dot_manager' => $linkageData['dot_manager'],
                    'tb_type' => $linkageData['tb_type'],
                    'eptb_subtype' => $linkageData['eptb_subtype'],
                    'patient_type' => $linkageData['patient_type'],
                    'culture' => $linkageData['culture'],
                    'regiment' => $linkageData['regiment'],
                    'hiv_status' => $linkageData['hiv_status']
                ]);
            } else {
                $linkage = PatientLinkage::findOrFail($id);
                $linkage->weight = $linkageData['weight'];
                $linkage->height = $linkageData['height'];
                $linkage->linkage_date = $linkageData['linkage_date'];
                $linkage->linkage_dept = $linkageData['linkage_dept'];
                $linkage->linkage_number = $linkageData['linkage_number'];
                $linkage->dot_manager = $linkageData['dot_manager'];
                $linkage->tb_type = $linkageData['tb_type'];
                $linkage->eptb_subtype = $linkageData['eptb_subtype'];
                $linkage->patient_type = $linkageData['patient_type'];
                $linkage->culture = $linkageData['culture'];
                $linkage->regiment = $linkageData['regiment'];
                $linkage->hiv_status = $linkageData['hiv_status'];
                $linkage->save();
            }
        } catch(\Throwable $th){
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

}
