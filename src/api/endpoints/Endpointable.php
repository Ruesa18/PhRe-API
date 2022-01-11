<?php
namespace PHREAPI\api\endpoints;

use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\output\AbstractResponse;

interface Endpointable {

    public function index(Request $request): AbstractResponse;

    public function create(Request $request): AbstractResponse;

    public function update(Request $request): AbstractResponse;

    public function patch(Request $request): AbstractResponse;

    public function option(Request $request): AbstractResponse;

    public function delete(Request $request): AbstractResponse;
}
?>
