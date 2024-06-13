<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerCreateRequest;
use App\Models\CustomerAttribute;
use App\Models\CustomerDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ?? 15;

        $order_by = $request->order_by ?? 'latest';
        $search = $request->search ? trim($request->search) : '';
        $query = User::withTrashed()->where('type', '=', 'customer')->with('customer_details');

        if ($search !== '') {
            $query->where('name', 'like', "%$request->search%")
                ->orWhere('email', 'like', "%$request->search%")
                ->orWhere('phone_number', 'like', "%$request->search%");
        }


        switch ($order_by) {
            case 'latest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name');
                break;
            case 'name_desc':
                $query->orderByDesc('name');
                break;
            case 'active':
                $query->where('status', true);
                break;
            case 'inactive':
                $query->where('status', false);
                break;
            default:
                $query->latest();
                break;
        }
        $paginate_count = $paginate !== '0' ? $paginate : $query->count();
        $customers = $query->paginate($paginate_count)->withQueryString();
        return view('admin.customers.index', compact('customers', 'paginate', 'order_by', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = CustomerAttribute::all()->groupBy('attribute_name');
        return view('admin.customers.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => 'customer',
            'status' => $request->status,
            'password' => Hash::make($request->password)
        ]);

        $image_name = uploadImage($request, 'image', 'profile_image');

        $customer_details = CustomerDetails::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'dob' => Carbon::createFromFormat('d/m/Y', $request->dob),
            'age' => dob_to_age($request->dob),
            'height' => $request->height,
            'education' => $request->education,
            'profession' => $request->profession,
            'sign_up_method' => 'local',
            'profile_image' => $image_name,
            'blood_group' => $request->blood_group,
        ]);

        $customer_details->update([
            'customer_id' =>  "PMU" . str_pad($customer_details->id, 6, 0, STR_PAD_LEFT)
        ]);

        return redirect()->route('admin.customer.index')->with([
            'status' => "Customer created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
