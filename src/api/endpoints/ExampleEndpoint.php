<?php
namespace PHREAPI\api\endpoints;

use PHREAPI\kernel\utils\output\AbstractResponse;
use PHREAPI\kernel\utils\output\JSONResponse;

class ExampleEndpoint extends Endpoint implements Endpointable {

    public function index($request): AbstractResponse {}

    public function create($request): AbstractResponse {}

    public function update($request): AbstractResponse {}

    public function patch($request): AbstractResponse {}

    public function option($request): AbstractResponse {}

    public function delete($request): AbstractResponse {}
}

?>
