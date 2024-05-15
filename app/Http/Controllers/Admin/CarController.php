<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarFormRequest;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CarController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:car-list|car-create|car-edit|car-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:car-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:car-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:car-delete'], ['only' => ['destroy']]);
    }
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }
    public function create()
    {
        $brands = Brand::all();
        return view('admin.cars.create', compact('brands'));
    }
    public function store(CarFormRequest $request)
    {
        $validatedData = $request->validated();

        $car = new Car;
        $car->name = $validatedData['name'];
        $car->variant = $validatedData['variant'];
        $car->number = $validatedData['number'];
        $car->color = $validatedData['color'];
        $car->seat = $validatedData['seat'];
        $car->fuel = $validatedData['fuel'];
        $car->transmision = $validatedData['transmision'];
        $car->vehicle_certificate = $validatedData['vehicle_certificate'];
        $car->status = $request->status == true ? '1' : '0';

        $car->save();
        return redirect('admin/cars')->with('message', 'Car Has Added');
    }
    public function edit(Car $car)
    {
        // dd($car);
        $brands = Brand::all();
        return view('admin.cars.edit', compact('car', 'brands'));
    }
    public function update(CarFormRequest $request, $car)
    {

        $validatedData = $request->validated();
        $car = Car::findOrFail($car);

        // $validCar = Rule::unique('cars', 'number')->ignore($car->id);

        $car->name = $validatedData['name'];
        $car->variant = $validatedData['variant'];
        $car->number = Rule::unique('cars', 'number')->ignore($car->id);
        $car->color = $validatedData['color'];
        $car->seat = $validatedData['seat'];
        $car->fuel = $validatedData['fuel'];
        $car->transmision = $validatedData['transmision'];
        $car->vehicle_certificate = $validatedData['vehicle_certificate'];
        $car->status = $request->status == true ? '1' : '0';

        $car->update();
        return redirect('admin/cars')->with('message', 'Brand update Succesfully');
    }
    public function destroy(int $car_id)
    {
        $car = Car::findOrFail($car_id);
        $car->delete();
        return redirect()->back()->with('message', 'Package has ben Deleted!');
    }
}
