<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Repository\StoreRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class StoreController extends Controller
{
    protected StoreRepository $repository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->repository = $storeRepository;
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function register(StoreRequest $request): JsonResponse
    {
        $params = $request->only(['name', 'address', 'personInCharge', 'email', 'description', 'password']);
        $params['password'] = Hash::make($params['password']);
        $result = $this->repository->create($params);

        return response()->json($result, 200);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function update(StoreRequest $request): JsonResponse
    {
        $result = $this->repository->update($request->get('id'), $request->only(['name', 'address', 'personInCharge', 'description']));

        if($result){
            return response()->json(['error' => "null"], 200);
        }else{
            return response()->json(['error' => "update failed"], 403);
        }
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function changePassword(StoreRequest $request): JsonResponse
    {
        $sid = $request->only(['id']);
        $data = $this->repository->one($sid);

        if(Hash::check($request->get('oldPassword'), $data->password))
        {
            $result = $this->repository->update($sid, ['password' => Hash::make($request->get('newPassword'))]);

            if($result){
                return response()->json(['error' => "null"], 200);
            }else{
                return response()->json(['error' => "update failed"], 403);
            }

        }else{
            return response()->json(['error' => "old password error"], 403);
        }
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function login(StoreRequest $request): JsonResponse
    {
        $params = $request->only(['email', 'password']);

        $result = $this->repository->query(["id", "email", "password"], ['email' => $params['email']]);

        if(count($result) === 1){

            if(Hash::check($params['password'], $result[0]->password)){
                $request->session()->put('sid', $result[0]->id);
                return response()->json($request->session()->all(), 200);
            }else{
                $request->session()->forget('sid');
                return response()->json(['error' => "password failed"], 400);
            }
        }else{
            return response()->json(['error' => "account failed", 'data' => $result], 400);
        }
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function logout(StoreRequest $request): JsonResponse
    {
        $request->session()->flush();
        Cookie::forget('laravel_session');
        return response()->json(['error' => null], 200);
    }
}
