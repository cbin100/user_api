<?php

namespace Cbin100\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
class User extends BaseController
{
    protected $url;

    /**
     * Initialisation of $url object
     */
    public function __construct()
    {
        $this->url = 'https://reqres.in/api';
    }

    /** Base Model function
     * @param $url
     * @param $id
     * @param $page
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function get_users($url, $id = null, $page = null)
    {
        try {
            if(isset($id)){
                $my_url = $url . '/users/' . $id ;
            }elseif (isset($page)){
                $my_url = $url . '/users?page=' . $page ;
            }else{
                $my_url = $url . '/users' ;
            }
            $response = Http::get($my_url);
            $data = json_decode($response->body(), true); // Decode guzzle string response
            if($data){
                return $data;
            }else{
                return $this->sendApiError('No data found!');
            }
        }catch (\Exception $exception){
            return $this->sendApiError('System Error: ' .$exception->getMessage());
        }
    }

    /** retrieve a single user by ID
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_single_user($user_id)
    {
        try {
            return $this->sendApiResponse($this->get_users($this->url, $user_id));
        }catch (\Exception $exception){
            return $this->sendApiError('System Error: ' .$exception->getMessage());
        }
    }

    /**
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_paginated_list_of_user($page)
    {
        try {
            return $this->sendApiResponse($this->get_users($this->url, null, $page));
        }catch (\Exception $exception){
            return $this->sendApiError('System Error: ' .$exception->getMessage());
        }
    }
    
    /** Bonus insert single user into redis cache
     * @param $user_id
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function insert_single_user_into_redis_cache($user_id)
    {
        try {
            Redis::del('cached_single_user_' . $user_id);
            $data = json_encode($this->get_users($this->url, $user_id), true);
            Redis::set('cached_single_user_' .$user_id, $data);
            return $data;
        }catch (\Exception $exception){
            return $this->sendApiError('System Error: ' .$exception->getMessage());
        }
    }
    
    /** Bonus get single user from redis cache
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_single_from_redis_cache($user_id)
    {
        try {
            $cached_single_user = Redis::get('cached_single_user_'. $user_id);
            if(isset($cached_single_user)) {
                return $this->sendApiResponse(json_decode($cached_single_user));
            }else{
                $cached_single_user = $this->insert_single_user_into_redis_cache($user_id);
                return $this->sendApiResponse(json_decode($cached_single_user));
            }
        }catch (\Exception $exception){
            return $this->sendApiError(['System Error' => $exception->getMessage()]);
        }
    }
    
    /** Bonus insert paginated list of user into redis cache
     * @param $page
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function insert_paginated_list_of_user_into_redis_cache($page)
    {
        try {
            //$data = $this->get_users($this->url, null, $page);
            $data = json_encode($this->get_users($this->url, null, $page), true);
            Redis::set('cached_paginated_user_' . $page, $data);
            //return $this->sendApiResponse($this->get_users($this->url, $user_id));
            return $data;
        }catch (\Exception $exception){
            return $this->sendApiError('System Error: ' .$exception->getMessage());
        }
    }
    
    /** Bonus get paginated list of user into redis cache
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_paginated_list_of_user_into_redis_cache($page)
    {
        try {
            $cached_paginated_user = Redis::get('cached_paginated_user_'. $page);
            if(isset($cached_paginated_user)) {
                return $this->sendApiResponse(json_decode($cached_paginated_user));
            }else{
                $cached_paginated_user = $this->insert_paginated_list_of_user_into_redis_cache($page);
                return $this->sendApiResponse(json_decode($cached_paginated_user));
            }
        }catch (\Exception $exception){
            return $this->sendApiError(['System Error' => $exception->getMessage()]);
        }
    }
}
