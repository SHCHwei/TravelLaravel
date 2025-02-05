<?php

namespace App\Http\Controllers;

use App\Repository\RoomTypeRepository;
use App\Http\Requests\RoomTypeRequest;
use Illuminate\Http\JsonResponse;
use App\Service\RoomService;

class RoomTypeController extends Controller
{
    protected RoomTypeRepository $repository;

    public function __construct(RoomTypeRepository $roomTypeRepository)
    {
        $this->repository = $roomTypeRepository;
    }

    /**
     * @param RoomService $roomService
     * @param RoomTypeRequest $request
     * @return JsonResponse
     */
    public function index(RoomService $roomService, RoomTypeRequest $request): JsonResponse
    {
        $params = [
            'name' => $request->get('name'),
            'top' => $request->get('top', 10000),
            'down' => $request->get('down', 1),
        ];

        $data = $this->repository->rooms($params);

        if(count($data) > 0)
        {
            $result = $roomService->list($data);
            return response()->json(["data" => $result]);
        }else{
            return response()->json(["message" => "No data found"]);
        }
    }


    /**
     * @param RoomTypeRequest $request
     * @return JsonResponse
     */
    public function create(RoomTypeRequest $request): JsonResponse
    {
        $params = $request->only(['name', 'description', 'price', 'count']);
        $params['sid'] = session('sid');
        $result = $this->repository->create($params);

        if($result['status'])
        {
            return response()->json(['message' => 'success'], 200);
        }else{
            return response()->json(['message' => 'fail'], 403);
        }
    }

    /**
     * @param RoomTypeRequest $request
     * @return JsonResponse
     */
    public function update(RoomTypeRequest $request): JsonResponse
    {
        $id = $request->get('id');
        $params = $request->only(['name', 'description', 'price', 'count']);
        $result = $this->repository->update($id, $params);

        if($result){
            return response()->json(['error' => "null"], 200);
        }else{
            return response()->json(['error' => "update failed"], 403);
        }
    }
}
