<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\SearchFormRequest;
use App\Http\Resources\API\User\UserCollection;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SearchFormRequest $request)
    {
        $users = User::query()->where('username', 'like', '%' . $request->validated()['username'] . '%')->where('id', '!=', $request->user()->id)->limit(10)->get();
        return new UserCollection($users);
    }
}
