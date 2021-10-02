<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Offices;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class OfficesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IOfficesService $service;

    public function __construct(IOfficesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var OfficesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $officeNumber = (int) ($args["office_number"] ?? 0);
        if ($officeNumber <= 0) {
            return new JsonResponse(["result" => $officeNumber, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var OfficesModel $model */
        $model = $this->service->createModel($data);
        $model->setOfficeNumber($officeNumber);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $officeNumber = (int) ($args["office_number"] ?? 0);
        if ($officeNumber <= 0) {
            return new JsonResponse(["result" => $officeNumber, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var OfficesModel $model */
        $model = $this->service->get($officeNumber);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var OfficesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $officeNumber = (int) ($args["office_number"] ?? 0);
        if ($officeNumber <= 0) {
            return new JsonResponse(["result" => $officeNumber, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($officeNumber);

        return new JsonResponse(["result" => $result]);
    }
}