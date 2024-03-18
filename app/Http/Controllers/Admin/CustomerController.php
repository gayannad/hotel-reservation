<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerRepositoryInterfaces;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    private CustomerRepositoryInterfaces $customerRepository;

    /**
     * @param CustomerRepositoryInterfaces $customerRepository
     */
    public function __construct(CustomerRepositoryInterfaces $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * show list of customers
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $customers = $this->customerRepository->index();

        if ($request->ajax()) {
            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewRoute = route('admin.customers.edit', $row->id);
                    $deleteRoute = route('admin.customers.delete', $row->id);
                    $btn = '<a href="' . $viewRoute . '" class="edit btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></a>
                    <a href="#" onclick="deleteRoom(' . $row->id . ')" class="edit btn btn-primary btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.customers.index');
    }

    /**
     * shows customer create page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $types = $this->customerRepository->index();
        return view('admin.customers.create', compact('types'));
    }

    /**
     * shows customer edit page
     * @param User $customer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(User $customer)
    {
        return view('admin.customers.create', compact('customer'));
    }

    /**
     * customer save method
     * @param CustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerRequest $request)
    {
        $this->customerRepository->store($request->all());
        return redirect()->back()->with('success', 'Customer created successfully.');
    }

    /**
     *customer update method
     * @param CustomerRequest $request
     * @param User $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $request, User $customer)
    {
        $this->customerRepository->update($request->all(), $customer->id);
        return redirect()->back()->with('success', 'Customer updated successfully.');
    }

    /**
     * delete customer
     * @param $roomTypeId
     * @return mixed
     */
    public function destroy($roomTypeId)
    {
        return $this->customerRepository->delete($roomTypeId);
    }
}
