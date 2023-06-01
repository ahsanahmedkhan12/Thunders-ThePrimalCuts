<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Menu;
use App\Models\AddOnMenu;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;
use Image;
use Str;
class AddEditMenu extends Component
{
      use WithFileUploads;
    public $titlename , $branchdata ,$categorydata   , $name , $image,
           $price , $slug , $description;

    public $addonmenu = [] , $relationship = [];

    public function render()
    {
               $this->updatedrelationship();
        return view('livewire.add-edit-menu');

    }

    protected $rules = [
        'name'=>['required','regex:/^[a-zA-Z0-9\s]*$/','max:150','min:3'],
        'image'=>['required','mimes:jpg,png,jpeg,webp','max:3000','dimensions:width=612,height=408'],
        'relationship.*.branch'=>['required','distinct','regex:/^[a-zA-Z0-9\s\-]*$/','max:50','min:30'],
        'relationship.*.category'=>['required','regex:/^[a-zA-Z0-9\s\-]*$/','max:50','min:30'],
        'price'=>['required','regex:/^\d{1,3}(,\d{3})*(\.\d\d)?$/','max:50','min:4'],
        'description'=>['nullable','regex:/^[a-zA-Z0-9\s\-\,\.\(\)\’]*$/','max:250','min:3'],
        'addonmenu.*.addonname'=>['nullable','distinct','regex:/^[a-zA-Z0-9\s]*$/','max:150','min:3'],
        'addonmenu.*.addonprice'=>['nullable','regex:/^\d{1,3}(,\d{3})*(\.\d\d)?$/','max:50','min:4'],
    ];

    protected $messages = [
            'name.required'=>'This name  is required ',
            'image.required'=>'This image  is required ',
            'name.regex'=>'Only allow Alphabet , Number and Space ',
            'image.mimes'=>'Only allow jpg,png,jpeg,webp ',
            'name.max'=>'Maximum value of 50 ',
            'image.max'=>'Maximum image size 3 MB ',
            'name.min'=>'Minimum value of 3',
            'image.dimensions'=>'Image dimensions  612X408',

            'addonmenu.*.addonname.required'=>'This Add-On Name is required ',
            'addonmenu.*.addonprice.required'=>'This Add-On Price is required ',
        
            'addonmenu.*.addonname.regex'=>'Only allow alphabet or number ',
            'addonmenu.*.addonprice.regex'=>'Only allow dollar pattran ',

            'addonmenu.*.addonname.max'=>'Maximum value 150',
            'addonmenu.*.addonprice.max'=>'Maximum value 50 ',

            'addonmenu.*.addonname.min'=>'Minimum value 3',
            'addonmenu.*.addonprice.min'=>'Minimum value 4 ',

            'addonmenu.*.addonname.distinct'=>'Add-On Name field has a duplicate value.',

            'relationship.*.branch.required'=>'This Branch is required ',
            'relationship.*.category.required'=>'This Category is required ',
        
            'relationship.*.branch.regex'=>'Only allow alphabet or number dash ',
            'relationship.*.category.regex'=>'Only allow alphabet or number dash ',

            'relationship.*.branch.max'=>'Maximum value 50',
            'relationship.*.category.max'=>'Maximum value 50 ',

            'relationship.*.branch.min'=>'Minimum value 30',
            'relationship.*.category.min'=>'Minimum value 30 ',

            'relationship.*.branch.distinct'=>'Branch Name field has a duplicate value.',
        ];

      public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->updatedrelationship();
    }

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Category::class, 'slug', $this->name);
    }

    public function resetinput()
    {
        // Reset all input properties
        $this->name = '';
        $this->image = '';
        $this->slug = '';
        $this->price = '';
        $this->description = '';
        $this->addonmenu = [];
        $this->relationship = [];
    }

    public function mount($id = null)
    {
        $this->branchdata = Branch::orderBy('created_at', 'asc')->get();
        $this->categorydata = collect();
        if ($id == null) {
            $this->titlename = "Add Menu";
            $this->addrelationship();
        } else {
            $this->titlename = "Edit Category";
        }
    }

    public function Addaddonmenu()
    {
        // Add a new addon menu item to the list
        $this->addonmenu[] = ['addonname' => '', 'addonprice' => ''];
    }

    public function Removeaddonmenu($index)
    {
        // Remove the addon menu item at the specified index
        unset($this->addonmenu[$index]);
        $this->addonmenu = array_values($this->addonmenu);
    }

    public function addrelationship()
    {
        // Add a new relationship item to the list
        $this->relationship[] = ['branch' => '', 'category' => '', 'categorydata' => null];
    }

    public function removerelationship($i)
    {
        // Remove the relationship item at the specified index
        unset($this->relationship[$i]);
        $this->relationship = array_values($this->relationship);
    }

    public function updatedrelationship()
    {
        try {
            // Check for duplicate branch names in the relationship list
            $check = collect($this->relationship);
            $checktwo = $check->unique('branch');
            if ($check != $checktwo) {
                $this->dispatchBrowserEvent('Swal', [
                    'title' => 'Branch Name field has a duplicate value.',
                    'icon' => 'warning',
                ]);
            }

            // Update the category data for each relationship item
            $this->relationship = collect($this->relationship)->map(function ($item) {
                $d = Category::where('branch_id', $item['branch'])->get();
                if (!empty($d)) {
                    $item['categorydata'] = $d;
                } else {
                    $item['categorydata'] = null;
                }
                return $item;
            })->toArray();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function submit()
    {
        if ($this->relationship == []) {
            $this->addrelationship();
        }

        $this->validate();

        // Resize and encode the image
        $img = Image::make($this->image)->encode('webp');
        $img->resize(610, 610);
        $filename = Str::random() . '.webp';

        foreach ($this->relationship as $key => $value) {
            $check = Menu::where('branch_id', $value['branch'])->where('cat_id', $value['category'])->where('name', Str::lower($this->name))->count();
            $branchname = Branch::where('id', $value['branch'])->first();
            if ($check > 0) {
                return session()->flash('error', 'This branch and category already add this menu name.' . $branchname->name);
            }
        }

        foreach ($this->relationship as $key => $value) {
            $price = $this->price;
            $price = str_replace(',', '', $price);

            // Create a new menu item
            $menu = Menu::create([
                'branch_id' => $value['branch'],
                'cat_id' => $value['category'],
                'name' => Str::title($this->name),
                'slug'  => $this->slug,
                'image' => $filename,
                'price' => $price,
                'description' => Str::ucfirst($this->description),
                'meta_title' => Str::title($this->name),
                'meta_description'  => Str::title($this->name),
                'meta_keyword' => Str::title($this->name),
            ]);

            if ($this->addonmenu != []) {
                foreach ($this->addonmenu as $key => $v) {
                    if ($v['addonname'] == "" && $v['addonprice'] == "") {
                        unset($this->addonmenu[$key]);
                        $this->addonmenu = array_values($this->addonmenu);
                    } else if ($v['addonname'] != "" && $v['addonprice'] == "") {
                        unset($this->addonmenu[$key]);
                        $this->addonmenu = array_values($this->addonmenu);
                    } else if ($v['addonname'] == "" && $v['addonprice'] != "") {
                        unset($this->addonmenu[$key]);
                        $this->addonmenu = array_values($this->addonmenu);
                    } else {
                        $addonprice = $v['addonprice'];
                        $addonprice = str_replace(',', '', $addonprice);
                        $branchtime = AddOnMenu::create([
                            'menu_id' => $menu->id,
                            'name' => $v['addonname'],
                            'price' => $addonprice,
                            'position' => $key,
                        ]);
                    }
                }
            }
        }

        // Save the image to storage
        Storage::disk('public')->put($filename, $img);

        $this->dispatchBrowserEvent('Swal', [
            'title' => 'Menu Add Successfully',
            'icon' => 'success',
        ]);

        // Reset input fields
        $this->resetinput();

        return redirect()->to('/control-area/menus');
    }


}
