<?php
namespace PHREAPI\api\endpoints;

use PHREAPI\kernel\utils\output\AbstractResponse;
use PHREAPI\kernel\utils\output\JSONResponse;
use PHREAPI\kernel\utils\interfaces\database\MySQL;

class ExampleEndpoint extends Endpoint implements Endpointable {
    private $data;

    public function index($request): AbstractResponse {
        $mysql = new MySQL("127.0.0.1", "phre-api-user", "PhRe-API", "phre-api");
        $data = $mysql->execute("SELECT * FROM user")->asObject("PHREAPI\api\model\UserModel");
        return new JSONResponse(200, $data);
    }

    public function create($request): AbstractResponse {}

    public function update($request): AbstractResponse {}

    public function patch($request): AbstractResponse {}

    public function option($request): AbstractResponse {}

    public function delete($request): AbstractResponse {}

    public function asAssoc() {}

    public function asObject() {}
}

?>
