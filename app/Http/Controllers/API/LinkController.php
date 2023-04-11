<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Services\LinkService;

class LinkController extends Controller
{
    private LinkService $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    public function store(LinkRequest $request)
    {
        $shortedLink = $this->linkService->store($request->validated('link'));

        return env('APP_URL') . '/' . $shortedLink->code;
    }

    public function redirectTo($code)
    {
        return redirect($this->linkService->getLink($code));
    }
}
