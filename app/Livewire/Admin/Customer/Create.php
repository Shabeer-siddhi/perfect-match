<?php

namespace App\Livewire\Admin\Customer;

use Livewire\Attributes\Validate;
use App\Models\CustomerAttribute;
use App\Models\Location\City;
use App\Models\Location\District;
use App\Models\Location\State;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Create extends Component
{
    protected $attribute_list;
    protected $state_list;
    protected $city_list;
    protected $district_list;

    // Form inputs
    public $name = "";
    public $email = "";
    public $phone_number = "";
    public $gender = "";
    public $dob = "";
    public $height = "";
    public $blood_group = "";
    public $education = "";
    public $profession = "";
    public $religion = "";
    public $caste = "";
    public $profile_image = "";
    public $gallery_image;
    public $status = 1;
    public $state;
    public $city;
    public $district;

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'city' => 'required|exists:cities,id',
            'district' => 'required|exists:cities,id',
            'state' => 'required|exists:states,id',
        ];
    }

    protected $listeners = [
        'stateSelected' => 'setState',
        'districtSelected' => 'setDistrict',
        'citySelected' => 'setCity',
    ];

    // $state_list;
    // protected $city_list;
    // protected $district_list;

    public function setState($data)
    {
        $this->state = $data['value'];
        $this->city = null;
        $this->district = null;
        $this->district_list = District::where('state_id', $data['value'])->get();
    }

    public function setDistrict($data)
    {
        $this->district = $data['value'];
        $this->city = null;
        $this->city_list = City::where('district_id', $data['value'])->get();
    }

    public function setCity($data)
    {
        $this->city = $data['value'];
    }

    public function __construct()
    {
        $this->attribute_list = CustomerAttribute::all()->groupBy('attribute_name');
        $this->state_list = State::all();
        // $this->city_list = collect();
        // $this->district_list = collect();
    }

    public function save()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.customer.create')
            ->with([
                'attribute_list' => $this->attribute_list,
                'state_list' => $this->state_list,
                'city_list' => $this->city_list,
                'district_list' => $this->district_list,
            ]);
    }
}
