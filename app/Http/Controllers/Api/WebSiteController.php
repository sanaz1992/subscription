<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebSiteRequest;
use App\Http\Resources\WebSiteResource;
use App\Repositories\WebSiteRepository;
use Illuminate\Http\Request;

class WebSiteController extends Controller
{
    public function index(WebSiteRepository $webSiteRepository, Request $request)
    {
        $websites = $webSiteRepository->all($request->order_by ?? null);
        return WebSiteResource::collection($websites);
    }

    public function store(StoreWebSiteRequest $request, WebSiteRepository $webSiteRepository)
    {
        $website = $webSiteRepository->store($request->all());
        return new WebSiteResource($website);
    }
}
