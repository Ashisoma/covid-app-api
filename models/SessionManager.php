<?php
namespace models;

require_once __DIR__ . "/../bootstrap.php";
use Illuminate\Database\Eloquent\Model;

class SessionManager extends Model {
    protected $table = "session_manager";

    protected $fillable = ["userID", "jwt", "issuedat", "expires_at","active"] ;
}
?>
