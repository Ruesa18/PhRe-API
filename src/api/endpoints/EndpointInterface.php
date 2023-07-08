<?php
namespace PHREAPI\api\endpoints;

use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\output\AbstractResponse;
use PHREAPI\kernel\utils\output\ResponseInterface;

interface EndpointInterface {

    public function index(Request $request): ResponseInterface;

    public function create(Request $request): ResponseInterface;

    public function update(Request $request): ResponseInterface;

    public function patch(Request $request): ResponseInterface;

    public function option(Request $request): ResponseInterface;

    public function delete(Request $request): ResponseInterface;
}
