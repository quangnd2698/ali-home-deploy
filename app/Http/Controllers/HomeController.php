<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeServiceInterface;

class HomeController extends Controller
{

    public function __construct(
        HomeServiceInterface $homeService
    ) {
        $this->homeService = $homeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->homeService->getIndex();
        return view('admin/home', ['data' => $data]);
    }

}
