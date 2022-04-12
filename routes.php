<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use controllers\web\FacilityController;
use controllers\mobile\MobileAppController;
use controllers\utils\NumberProvider;
use controllers\web\DashboardController;
use controllers\web\LabController;
use controllers\web\PatientsController;
use controllers\web\ReportsController;
use controllers\web\ScreeningController;
use controllers\web\UsersController;
use models\County;
use models\CovidVaccine;
use models\Facility;
use models\Project;
use models\SessionManager;
use models\SubCounty;
use models\User;
use models\UserCategory;

$router = new Router();

// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    $notFound = file_get_contents("404.html");
    echo $notFound;
});

$router->get('/accessRoute', function () {
    echo 'Welcome';
});

$router->get('/getInitialData', function () {
    require "authMobile.php";
    $data = [];
    $data['facilities'] = Facility::all();

    $counties = County::all();
    foreach ($counties as $county) {
        $county['subcounties'] = SubCounty::where('county_code', $county->code)->get();
    }
    $data['counties'] = $counties;

    $jsonData = file_get_contents("assets/data.json");
    $json = json_decode($jsonData, true);

    $data['nationalities'] = $json['nationalities'];
    $data['lab_test_types'] = $json['lab_test_types'];
    $data['radiology_test_types'] = $json['xray_test_types'];
    $data['xray_results'] = $json['xray_results'];
    echo json_encode($data);
});

$router->post('/app_login', function () {
    require "authMobile.php";
    $controller = new MobileAppController();
    $controller->login($_POST);
});

$router->post('/app_register', function () {
    require "authMobile.php";
    $controller = new MobileAppController();
    $controller->register($_POST);
});

$router->get('/verify_token', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    try {
        $token = $_SERVER['HTTP_TOKEN'];
        $session = SessionManager::where('jwt', $token)->firstOrFail();
        $userID = $session->userID;
        $user = User::where('id', $userID)->firstOrFail();
        $userCategory = UserCategory::findOrFail($user->category);
        $user['userCategory'] = $userCategory->name;
        $user['token'] = $token;

        echo json_encode($user);
    } catch (\Throwable $e) {
        logError(UNAUTHORIZED_RESPONSE_CODE, $e->getMessage());
        http_response_code(UNAUTHORIZED_RESPONSE_CODE);
    }
});

$router->get('/get_patients', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $mflCode = $_GET['mflCode'];
    $controller = new MobileAppController();
    $controller->getPatients($mflCode);
});

$router->post('/register_patient', function () {
    require "authMobile.php";
    $controller = new MobileAppController();
    $controller->savePatient($_POST);
});

$router->post('/search_patient', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $controller = new MobileAppController();
    $controller->searchPatient($_POST['searchParam']);
});

$router->post('/save_triage_data', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $controller = new MobileAppController();
    $controller->saveTriage($_POST);
});

$router->post('/save_screening_data', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $controller = new MobileAppController();
    $controller->saveScreeningForm($_POST);
});

$router->get('/get_patient_contacts', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $patientId = $_GET['patientId'];
    $controller = new MobileAppController();
    echo json_encode($controller->getPatientContacts($patientId));
});

$router->post('/save_patient_contact', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $controller = new MobileAppController();
    $controller->savePatientContact($_POST);
});

$router->post('/save_contact_tracing_data', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $controller = new MobileAppController();
    $controller->saveContactTracingForm($_POST);
});

$router->post('/save_lab_request', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $controller = new MobileAppController();
    $controller->saveLabRequest($_POST);
});

$router->post('/save_radiology_request', function () {
    require "authMobile.php";
    require "jwt_verify.php";
    $controller = new MobileAppController();
    $controller->saveRadiologyRequest($_POST);
});

$router->post('save_patient', function () {
    $controller = new PatientsController();
    $controller->savePatient($_POST);
});

// My routes

$router->get('get_patient_history', function (){
    require "authMobile.php";
    require "jwt_verify.php";
    $patientId = $_GET['patientId'];
    $controller = new MobileAppController();
    echo json_encode($controller->getPatientHistory($patientId));
});

$router->get('get_radiology_request', function (){
    require "authMobile.php";
    require "jwt_verify.php";
    $patientId = $_GET['patientId'];
    $controller = new MobileAppController();
    echo json_encode($controller->getRadiologyData($patientId));
});

$router->get('get_lab_results', function (){
    require "authMobile.php";
    require "jwt_verify.php";
    $patientId = $_GET['patientId'];
    $controller = new MobileAppController();
    echo json_encode($controller->getLabRequests($patientId));
});

// end of mobile routes

// my routeModels

$router->post("/panel/set_active", function () {
    $mobile = $_POST;
    UsersController::setActiveToZero($mobile);
});

// Beginning of web routes

$router->post("/panel/login", function () {
    UsersController::login($_POST);
});
$router->post("/panel/register", function () {
    UsersController::register($_POST);
});

$router->post("/panel/forgot_reset", function () {
    $userData = $_POST;
    UsersController::forgot_pass($userData);
});

$router->post("/panel/forgot_password", function () {

});
$router->all('/panel/logout', function () {
    session_start();
    if (!session_destroy()) http_response_code(412);
    echo "session destroyed";
});

$router->get('/panel/get_permissions', function () {
    $controller = new UsersController();
    echo json_encode($controller->getPermissions());
});
$router->get('/panel/user_categories', function () {
    $controller = new UsersController();
    echo json_encode($controller->getUserCategories());
});
$router->post('/panel/save_user_category', function () {
    $controller =  new UsersController();
    $controller->saveUserCategory($_POST);
});
$router->get('/panel/get_projects', function () {
    $projects = Project::all();
    echo json_encode($projects);
});
$router->get('/panel/get_facilities', function () {
    $controller = new FacilityController();
    echo json_encode($controller->getFacilities());
});

$router->post('/panel/save_facility', function () {
    $controller = new FacilityController();
    $controller->saveFacility($_POST);
});

$router->get('/panel/get_users', function () {
    $controller = new UsersController();
    echo json_encode($controller->getUsers());
});

$router->post('/panel/save_user', function () {
    $controller = new UsersController();
    $controller->saveUser($_POST);
});

$router->get('/panel/counties_data', function () {
    // require "auth.php";
    $counties = models\County::all();
    foreach ($counties as $county) {
        $subcounties = models\SubCounty::where('county_code', $county->code)->get();
        $county['subcounties'] = $subcounties;
    }
    echo myJsonResponse(200, "Counties and subcounties", $counties);
});

$router->post('/panel/save_patient', function () {
    $controller = new PatientsController();
    $controller->savePatient($_POST);
});
$router->get('/panel/searchPatient/{searchString}', function ($searchString) {
    $controller = new PatientsController();
    echo json_encode($controller->searchPatient($searchString));
});
$router->post('/panel/saveTriage', function () {
    $controller = new PatientsController();
    $controller->saveTriageForm($_POST);
});
$router->post('/panel/saveScreening', function () {
    $controller = new ScreeningController();
    $controller->savePatientScreening($_POST);
});
$router->post('/panel/saveLabRequest', function () {
    $controller = new LabController();
    $controller->saveLabRequest($_POST);
});
$router->post('/panel/saveLabResult', function (){
    $controller = new LabController();
    $controller->saveLabResults($_POST);
});
$router->get('/panel/lab_requests/{patient_id}', function ($patient_id) {
    $controller = new LabController();
    echo json_encode($controller->getPatientLabRequests($patient_id));
});
$router->post('/panel/saveRadRequest', function (){
    $controller = new RadiologyController();
    $controller->saveRadRequest($_POST);
});
$router->post('/panel/save_contact', function (){
    $controller = new PatientsController();
    $controller->saveContact($_POST);
});
$router->post('/panel/save_contact_tracing', function () {
    $controller = new PatientsController();
    $controller->saveContactTracing($_POST);
});
$router->get('/panel/getContacts/{patientId}', function ($patientId) {
    $controller = new PatientsController();
    echo json_encode($controller->getActiveContacts($patientId));
});
$router->get('/panel/getDashboardData', function () {
    $controller = new DashboardController();
    $controller->getDashboardData();
});
$router->post("/panel/savePatientManagement", function () {
    $controller = new PatientsController();
    $controller->savePatientManagement($_POST);
});
$router->post("/panel/savePatientHistory", function () {
    $controller = new PatientsController();
    $controller->savePatientHistory($_POST);
});
$router->get('/panel/patientManagementData/{patientId}', function ($patientId) {
    $controller = new PatientsController();
    $controller->getPatientManagementPageData($patientId);
});
$router->post('/panel/uploadFiles', function (){
    echo \controllers\utils\Utility::uploadFiles();
});
$router->post('/panel/link_patient', function (){
    $controller = new PatientsController();
    $controller->linkPatient($_POST);
});

// Reports
$router->get("/panel/report/covidData", function () {
    $controller = new ReportsController();
    $controller->generateCovidReportData('', '');
});
$router->get("/panel/vaccines", function () {
    echo json_encode(CovidVaccine::all());
});

//Testing number client for patient
$router->get('/ptest/numclient', function () {
    echo NumberProvider::generatePatientNumber("12345");
});

// Thunderbirds are go!
$router->run();
