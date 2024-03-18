<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoomStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Interfaces\RoomsRepositoryInterfaces;
use App\Interfaces\RoomTypeRepositoryInterfaces;
use App\Models\Room;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    private RoomsRepositoryInterfaces $roomRepository;
    private RoomTypeRepositoryInterfaces $roomTypeRepository;

    /**
     * @param RoomsRepositoryInterfaces $roomRepository
     * @param RoomTypeRepositoryInterfaces $roomTypeRepository
     */
    public function __construct(RoomsRepositoryInterfaces $roomRepository, RoomTypeRepositoryInterfaces $roomTypeRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->roomTypeRepository = $roomTypeRepository;
    }

    /**
     * show list of rooms
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $rooms = $this->roomRepository->index();

        if ($request->ajax()) {
            return DataTables::of($rooms)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewRoute = route('admin.rooms.edit', $row->id);
                    $deleteRoute = route('admin.rooms.delete', $row->id);
                    $btn = '<a href="' . $viewRoute . '" class="edit btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                    <a href="#" onclick="deleteRoom(' . $row->id . ')" class="edit btn btn-primary btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>';
                    return $btn;
                })
                ->editColumn('price', function ($row) {
                    return "LKR." . number_format($row->price, 2);
                })
                ->editColumn('status', function ($row) {
                    $badgeColors = [
                        RoomStatus::AVAILABLE->value => 'success',
                        RoomStatus::RESERVED->value => 'warning',
                    ];
                    if ($row->status == RoomStatus::AVAILABLE->value) {
                        $status = RoomStatus::AVAILABLE->name;
                    } else {
                        $status = RoomStatus::RESERVED->name;
                    }
                    if (array_key_exists($row->status, $badgeColors)) {
                        return '<span class="badge badge-' . $badgeColors[$row->status] . '">' . $status . '</span>';
                    }

                    return $status;

                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.rooms.index');
    }

    /**
     * show room create page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $types = $this->roomTypeRepository->index();
        return view('admin.rooms.create', compact('types'));
    }

    /**
     * show room edit page
     * @param Room $room
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Room $room)
    {
        $types = $this->roomTypeRepository->index();
        return view('admin.rooms.create', compact('room', 'types'));
    }

    /**
     * room save method
     * @param RoomRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoomRequest $request)
    {
        $this->roomRepository->store($request->all());
        return redirect()->back()->with('success', 'Room created successfully.');
    }

    /**
     * room update method
     * @param RoomRequest $request
     * @param Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoomRequest $request, Room $room)
    {
        $this->roomRepository->update($request->all(), $room->id);
        return redirect()->back()->with('success', 'Room updated successfully.');
    }

    /**
     * room delete method
     * @param $roomTypeId
     * @return mixed
     */
    public function destroy($roomTypeId)
    {
        return $this->roomRepository->delete($roomTypeId);
    }
}
