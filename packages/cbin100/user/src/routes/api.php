<?php
    use Cbin100\User\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    /**
     * User API Routes
     */
    /*Route::GET('/cbin/users/page/{page}', [User::class, 'get_paginated_list_of_user'])->name('get_paginated_list_of_user');
    Route::GET('/cbin/redis/users/page/{page}', [User::class, 'get_paginated_list_of_user_into_redis_cache'])->name('get_paginated_list_of_user_into_redis_cache');

    Route::GET('/cbin/users/{user_id}', [User::class, 'get_single_user'])->name('get_single_user');
    Route::GET('/cbin/redis/users/{user_id}', [User::class, 'get_single_from_redis_cache'])->name('get_single_user');
    */

    Route::GET('/cbin/users/page/{page}', [\Cbin100\User\User::class, 'get_paginated_list_of_user'])->name('get_paginated_list_of_user');
    Route::GET('/cbin/redis/users/page/{page}', [\Cbin100\User\User::class, 'get_paginated_list_of_user_into_redis_cache'])->name('get_paginated_list_of_user_into_redis_cache');

    Route::GET('/cbin/users/{user_id}', [\Cbin100\User\User::class, 'get_single_user'])->name('get_single_user');
    Route::GET('/cbin/redis/users/{user_id}', [\Cbin100\User\User::class, 'get_single_from_redis_cache'])->name('get_single_user');


