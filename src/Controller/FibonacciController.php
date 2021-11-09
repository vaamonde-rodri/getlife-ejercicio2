<?php

namespace App\Controller;

use App\Service\Fibonacci;
use App\Service\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/")
 */
class FibonacciController {


    /**
     * @Route(path="fibonacci", name="get_fibonacci", methods={"GET"})
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function getFibonacci(Request $request): JsonResponse {

        $initDate = $request->query->get('initDate');
        $endDate  = $request->query->get('endDate');

        if (!Validator::datetime($initDate, 'Y-m-d H:i:s')) {
            return new JsonResponse(["status" => "error", "error" => "La fecha de inicio no tiene un formato correcto"], Response::HTTP_BAD_REQUEST);
        }
        if (!Validator::datetime($endDate, 'Y-m-d H:i:s')) {
            return new JsonResponse(["status" => "error", "error" => "La fecha de fin no tiene un formato correcto"], Response::HTTP_BAD_REQUEST);
        }

        $fibonacci = Fibonacci::betweenDates($initDate, $endDate);
        return new JsonResponse(["status" => "success", "result" => $fibonacci], Response::HTTP_OK);
    }
}