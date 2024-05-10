<?php

namespace App\Http\Livewire\Admin\Brand;

use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Brand;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $brand_id;


    public function deleteBrand($brand_id)
    {
        // dd($brand_id);
        $this->brand_id = $brand_id;
    }
    public function destroyBrand()
    {
        $brand = Brand::find($this->brand_id);
        // dd($brand, $this->brand_id);
        $path = 'uploads/brand/' . $brand->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $brand->delete();
        session()->flash('message', 'brand Deleted');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands]);
    }
}
