<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeRequest;
use App\Interfaces\RoomTypeRepositoryInterfaces;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoomTypeController extends Controller
{
    private RoomTypeRepositoryInterfaces $roomTypeRepository;

    /**
     * @param RoomTypeRepositoryInterfaces $roomTypeRepository
     */
    public function __construct(RoomTypeRepositoryInterfaces $roomTypeRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
    }

    /**
     * show list of room types
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $roomTypes = $this->roomTypeRepository->index();

        if ($request->ajax()) {
            return DataTables::of($roomTypes)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewRoute = route('admin.room-types.edit', $row->id);
                    $deleteRoute = route('admin.room-types.delete', $row->id);
                    $btn = '<a href="' . $viewRoute . '" class="edit btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                    <a href="#" onclick="deleteRoomType(' . $row->id . ')" class="edit btn btn-primary btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.room-types.index');
    }

    /**
     * shows room type create page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('admin.room-types.create');
    }

    /**
     * shows room type edit page
     * @param RoomType $roomType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(RoomType $roomType)
    {
        return view('admin.room-types.create', compact('roomType'));
    }

    /**
     * room type save method
     * @param RoomTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoomTypeRequest $request)
    {
        $this->roomTypeRepository->store($request->all());
        return redirect()->back()->with('success', 'Room type created successfully.');
    }

    /**
     * room type update method
     * @param RoomTypeRequest $request
     * @param RoomType $roomType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoomTypeRequest $request, RoomType $roomType)
    {
        $this->roomTypeRepository->update($request->all(), $roomType->id);
        return redirect()->back()->with('success', 'Room type updated successfully.');
    }

    /**
     * room type delete method
     * @param $roomTypeId
     * @return mixed
     */
    public function destroy($roomTypeId)
    {
        return $this->roomTypeRepository->delete($roomTypeId);
    }
}
