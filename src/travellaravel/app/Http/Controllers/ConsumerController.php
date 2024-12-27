<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsumerRequest;
use App\Repository\CustomRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;


class ConsumerController extends Controller
{
    protected CustomRepository $repository;

    public function __construct(CustomRepository $customRepository)
    {
        $this->repository = $customRepository;
    }

    /**
     * @param ConsumerRequest $request
     * @return JsonResponse
     */
    public function register(ConsumerRequest $request): JsonResponse
    {
        $params = $request->only(['name', 'gender', 'birthday', 'email', 'password']);
        $params['password'] = Hash::make($params['password']);
        $result = $this->repository->create($params);

        return response()->json($result, 200);
    }

    /**
     * @param ConsumerRequest $request
     * @return JsonResponse
     */
    public function update(ConsumerRequest $request) : JsonResponse
    {

        $result = $this->repository->update(session('cid'), $request->only(['name', 'gender', 'birthday']));

        if($result){
            return response()->json(['error' => "null"], 200);
        }else{
            return response()->json(['error' => "update failed"], 403);
        }
    }

    /**
     * @param ConsumerRequest $request
     * @return JsonResponse
     */
    public function overview(ConsumerRequest $request) : JsonResponse
    {

        $result = $this->repository->query(['id', 'name', 'gender', 'birthday', 'created_at', 'updated_at'], ['id' => session('cid')]);

        if($result){
            return response()->json(['error' => null, 'data' => $result], 200);
        }else{
            return response()->json(['error' => "update failed"], 403);
        }
    }

    /**
     * @param ConsumerRequest $request
     * @return JsonResponse
     */
    public function changePassword(ConsumerRequest $request): JsonResponse
    {

        $cid = session('cid');
        $data = $this->repository->one($cid);

        if(Hash::check($request->get('oldPassword'), $data->password))
        {
            $result = $this->repository->update($cid, ['password' => Hash::make($request->get('newPassword'))]);

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
     * @param ConsumerRequest $request
     * @return JsonResponse
     */
    public function login(ConsumerRequest $request): JsonResponse
    {
        $params = $request->only(['email', 'password']);

        $result = $this->repository->query(["id", "email", "password"], ['email' => $params['email']]);

        if(count($result) === 1){

            if(Hash::check($params['password'], $result[0]->password))
            {
                $request->session()->flush();
                $request->session()->put('cid', $result[0]->id);
                return response()->json($request->session()->all(), 200);
            }else{
                $request->session()->forget('cid');
                return response()->json(['error' => "password failed"], 400);
            }
        }else{
            return response()->json(['error' => "account failed", 'data' => $result], 400);
        }

    }

    /**
     * @param ConsumerRequest $request
     * @return JsonResponse
     */
    public function logout(ConsumerRequest $request): JsonResponse
    {
        $request->session()->flush();
        Cookie::forget('laravel_session');
        return response()->json(['error' => null], 200);
    }
}
