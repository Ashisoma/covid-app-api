<?php

namespace controllers\web;

use controllers\utils\Utility;
use models\Facility;
use models\Permission;
use models\Project;
use models\User;
use models\UserCategory;

class UsersController
{

    public function __construct()
    {
        require_once('./auth.php');
        $this->user = $_SESSION['user'];
    }

    public static function login($userData){
        try {
            $email = $userData['phone'];
            $password = $userData['password'];
            $user = User::where('phone', $email)->where('active', 1)->firstOrFail();
            if (password_verify($password, $user->password)) {
                $user->last_login = date("Y:m:d h:i:s", time());
                $user->save();
                $categoryData = UserCategory::findOrFail($user->category);
                $user['categoryData'] = $categoryData;
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['expires_at'] = time() + ($_ENV['SESSION_DURATION'] * 60);
//                echo myJsonResponse(200, 'Logged in', $user);
                // header('Location: ../panel/index');
            } else throw new \Exception("Invalid Credentials.", 1);
        } catch (\Throwable $e) {
            Utility::logError($e->getCode(), $e->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
//            echo myJsonResponse($e->getCode(), "Error encountered. Try again later.", $e->getMessage());
        }
    }

    // FORGOT PASSWORD 
    public static function forgot_password($userData){
        try{
            $email = $userData['email'];
            $user = User::where('email', $email)->where('active', 1)->firstOrFail();
            // check if user 
            if ($user ) {
                # code...
            }
            // edit the verify token 

            // add an email

        }catch (\Throwable $th){
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public static function register($userData){
        try {
            $phone = $userData['phone'];
            $password = $userData['password'];
            throw_if(strlen($phone) < 10, new \Exception("invalid phone number. " . $phone, INVALID_DATA_RESPONSE_CODE));
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $user = User::where('phone', $phone)->where('active', 0)->firstOrFail();
            $user->password = $hashedpassword;
            $user->active = 1;
            $user->save();
            
            self::login($userData);
        } catch (\Throwable $e) {
            logError($e->getCode(), $e->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }

    public static function setActiveToZero($mobile){
        try {
            $phone = $mobile['phone'];
            throw_if(strlen($phone) < 10, new \Exception("invalid phone number. " . $phone, INVALID_DATA_RESPONSE_CODE));
            $user = User::where('phone', $phone)->where('active', 1)->firstOrFail();
            $user->active = 0;
            $user->save();
        } catch (\Throwable $e) {
            logError($e->getCode(), $e->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        } 
    }

    public static function forgot_pass($userData){
        try {
            $phone = $userData['phone'];
            $password = $userData['password'];
            throw_if(strlen($phone) < 10, new \Exception("invalid phone number. " . $phone, INVALID_DATA_RESPONSE_CODE));
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $user = User::where('phone', $phone)->where('active', 0)->firstOrFail();
            $user->password = $hashedpassword;
            $user->active = 1;
            $user->save();
            
            self::login($userData);
        } catch (\Throwable $e) {
            logError($e->getCode(), $e->getMessage());
            http_response_code(PRECONDITION_FAILED_ERROR_CODE);
        }
    }
    public function saveUser($userData){
        $params = ['names', 'gender', 'email', 'phone', 'project', 'facility'];
        try {
            $missing = Utility::checkMissingAttributes($userData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if (isset($userData['id']) && $userData['id'] != '') $id = $userData['id'];
            if($id == '') {
                User::create([
                    'names' => $userData['names'],
                    'gender' => $userData['gender'],
                    'email' => $userData['email'],
                    'phone' => $userData['phone'],
                    'project' => $userData['project'],
                    'category' => $userData['category'],
                    'facility' => $userData['facility'],
                ]);
            } else {
                $user = User::findOrFail($id);
                $user->names = $userData['names'];
                $user->gender = $userData['gender'];
                $user->email = $userData['email'];
                $user->phone = $userData['phone'];
                $user->project = $userData['project'];
                $user->category = $userData['category'];
                $user->facility = $userData['facility'];
                $user->save();
            }
            echo json_encode($this->getUsers());
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
        }
    }

    public function getUsers(){
        //TODO: Filter depending on logged in user
        $users = User::all();
        foreach($users as $user){
            $categoryData = UserCategory::find($user->category);
            $projectData = Project::find($user->project);
            $facilityData = Facility::find($user->facility);
            $user['categoryData'] = $categoryData;
            $user['projectData'] = $projectData;
            $user['facilityData'] = $facilityData;
        }
        return $users;
    }


    public function getPermissions(){
        return Permission::all();
    }

    public function saveUserCategory($categoryData) {
        $params = ['name', 'description', 'permissions', 'access_level'];
        try{
            $missing = Utility::checkMissingAttributes($categoryData, $params);
            if(sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if(isset($categoryData['id']) && $categoryData['id'] != null) $id = $categoryData['id'];
            if($id != ''){
                $category = UserCategory::findOrFail($id);
                $category->name = $categoryData['name'];
                $category->description = $categoryData['description'];
                $category->access_level = $categoryData['access_level'];
                $category->permissions = json_encode($categoryData['permissions']);
                $category->save();
            } else {
                UserCategory::create([
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'access_level' => $categoryData['access_level'],
                    'permissions' => json_encode($categoryData['permissions']),
                ]);
            }
            echo json_encode($this->getUserCategories());
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
        }
    }

    public function getUserCategories(){
        $categories = UserCategory::all();
        return $categories;
    }

    

}
