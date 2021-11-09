<?php

namespace App\Controller;

use App\Service\Fibonacci;
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
     */
    public function getFibonacci(Request $request): JsonResponse {

        $initDate = $request->query->get('initDate');
        $endDate  = $request->query->get('endDate');



        $fibonacci = Fibonacci::betweenDates($initDate, $endDate);
        return new JsonResponse(["result" => $fibonacci], Response::HTTP_OK);
    }
}