<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderRequest;
use App\Service\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function ordersByConsumer(OrderRequest $request): JsonResponse
    {
        $params = $request->only(['startDate', 'endDate', 'status']);
        $params['cid'] = session('cid');
        $result = $this->orderService->getOrders($params);

        return response()->json($result, 200);
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function create(OrderRequest $request): JsonResponse
    {
        $params = $request->only(['rid', 'checkin', 'checkout', 'money', 'payType']);
        $params['cid'] = session('cid');
        $result = $this->orderService->newOrder($params);

        if($result['status']){
            return response()->json($result, 200);
        }else{
            return response()->json($result, 400);
        }
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function detail(OrderRequest $request): JsonResponse
    {
        $result = $this->orderService->getOrderById($request->get('id'));

        return response()->json($result, 200);
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function payment(OrderRequest $request): JsonResponse
    {
        $params = $request->only(['id', 'payType', 'payed']);
        $result = $this->orderService->payment($params);

        return response()->json($result, 200);
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function cancelOrder(OrderRequest $request): JsonResponse
    {
        $result = $this->orderService->cancel($request->get('id'));

        return response()->json($result, 200);
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function ordersByStore(OrderRequest $request): JsonResponse
    {
        $params = $request->only(['startDate', 'endDate', 'status']);
        $data = $this->orderService->ordersByStore($params);
        return response()->json($data, 200);
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function updateOrder(OrderRequest $request): JsonResponse
    {
        $result = $this->orderService->operationByStore($request->get('id'), $request->except(['id']));
        return response()->json($result, 200);
    }
}
