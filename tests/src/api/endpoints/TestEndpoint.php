<?php

namespace PHREAPITests\src\api\endpoints;

use PHREAPI\kernel\utils\endpoints\AbstractEndpoint;
use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\output\JSONResponse;
use PHREAPI\kernel\utils\output\ResponseInterface;

class TestEndpoint extends AbstractEndpoint {
    public function index(Request $request): ResponseInterface {
        return new JSONResponse(200, ['name' => 'test']);
    }

    public function create(Request $request): ResponseInterface {
        return new JSONResponse(201);
    }
}
