<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRegisterRequest;
use App\Services\ClientsService;
use Ramsey\Uuid\UuidInterface;

final class ClientsController extends Controller
{
    /** @var \App\Services\ClientsService */
    private $service;

    public function __construct(ClientsService $service)
    {
        $this->service = $service;
    }

    public function register(ClientRegisterRequest $request)
    {
        return [
            'id' => $this->service->register($request->getEmail()),
        ];
    }

    public function get(UuidInterface $id)
    {
        return [
            'id' => $this->service->getById($id)->getId(),
        ];
    }
}