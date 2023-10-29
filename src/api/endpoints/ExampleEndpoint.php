<?php
namespace PHREAPI\api\endpoints;

use PHREAPI\api\model\UserModel;
use PHREAPI\kernel\utils\endpoints\AbstractEndpoint;
use PHREAPI\kernel\utils\exceptions\MissingParameterException;
use PHREAPI\kernel\utils\input\Request;
use PHREAPI\kernel\utils\interfaces\database\MySQL;
use PHREAPI\kernel\utils\output\JSONResponse;
use PHREAPI\kernel\utils\output\ResponseInterface;

class ExampleEndpoint extends AbstractEndpoint {
    public function index(Request $request): ResponseInterface {
        $mysql = new MySQL();
        $data = $mysql->execute('SELECT * FROM user')->asObjects(UserModel::class);
        return (new JSONResponse(200))->setBody($data);
    }

    /**
     * @throws \JsonException
     */
    public function create(Request $request): ResponseInterface {
        $mysql = new MySQL();
        $data = $request->getData();
        $mysql->execute('INSERT INTO user(username, password) VALUES(:username, :password)',
            [
                'username' => $data->username,
                'password' => $data->password,
            ]
        );
        $mysql->asAssoc();
        return (new JSONResponse(201))->setBody($data);
    }

    /**
     * @throws MissingParameterException|\JsonException
     */
    public function delete(Request $request): ResponseInterface {
        $mysql = new MySQL();
        $parameters = $request->getParameters();

        if(!array_key_exists(0, $parameters) || !is_numeric($parameters[0])) {
            throw new MissingParameterException();
        }

        $users = $mysql->execute('SELECT * FROM user WHERE id = :id',
            [
                'id' => $parameters[0],
            ]
        )->asObjects();

        if(count($users) === 0) {
            return new JSONResponse(404);
        }

        $mysql->execute('DELETE FROM user WHERE id = :id',
            [
                'id' => $parameters[0],
            ]
        );

        return (new JSONResponse(200))->setBody(['id' => $parameters[0]]);
    }
}
