<?php

namespace PHREAPI\kernel\utils\endpoints;

use PHREAPI\kernel\utils\exceptions\UnhandledHttpMethodException;
use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\output\ResponseInterface;

class AbstractEndpoint implements EndpointInterface {

    public function index(Request $request): ResponseInterface {
        throw new UnhandledHttpMethodException();
    }

    public function create(Request $request): ResponseInterface {
        throw new UnhandledHttpMethodException();
    }

    public function update(Request $request): ResponseInterface {
        throw new UnhandledHttpMethodException();
    }

    public function patch(Request $request): ResponseInterface {
        throw new UnhandledHttpMethodException();
    }

    public function option(Request $request): ResponseInterface {
        throw new UnhandledHttpMethodException();
    }

    /**
     * @throws UnhandledHttpMethodException
     */
    public function delete(Request $request): ResponseInterface {
        throw new UnhandledHttpMethodException();
    }
}
