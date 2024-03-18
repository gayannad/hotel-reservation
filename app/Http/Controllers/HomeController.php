<?php

namespace App\Http\Controllers;

use App\Interfaces\RoomsRepositoryInterfaces;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private RoomsRepositoryInterfaces $roomsRepository;

    /**
     * Create a new controller instance.
     *
     * @param RoomsRepositoryInterfaces $roomsRepository
     */
    public function __construct(RoomsRepositoryInterfaces $roomsRepository)
    {
        $this->middleware('auth');
        $this->roomsRepository = $roomsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * show customer dashboard
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function customerDashboard()
    {
        $rooms = $this->roomsRepository->index();
        return view('customer-dashboard', compact('rooms'));
    }
}
