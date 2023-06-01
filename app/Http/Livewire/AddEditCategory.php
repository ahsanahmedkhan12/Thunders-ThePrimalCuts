<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Branch;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;
use Image;
use Str;
class AddEditCategory extends Component
{
    use WithFileUploads;
    public $titlename , $branchdata , $branch = [] , $name , $image , $slug , $description;
    public function render()
    {
        return view('livewire.add-edit-category');
    }
     public function resetinput(){

        $this->name = '';
        $this->image = '';
        $this->slug = '';
        $this->branch = []; 
    }
    public function mount($id=null){
        $this->branchdata = Branch::orderBy('created_at', 'asc')->get();
      
       if($id == null){
            $this->titlename = "Add Category";

       }else{

          $this->titlename = "Edit Category";
       }
    }

     protected $rules = [
        'name'=>['required','regex:/^[a-zA-Z0-9\s]*$/','max:50','min:3','unique:branches,name'],
        'image'=>['required','mimes:jpg,png,jpeg,webp','max:3000','dimensions:width=612,height=408'],
        'description'=>['nullable','regex:/^[a-zA-Z0-9\s\-\,\.\(\)]*$/','max:250','min:3'],
    ];
    protected $messages = [
             'name.required'=>'This name  is required ',
             'image.required'=>'This image  is required ',
            
             'name.regex'=>'Only allow Alphabet , Number and Space ',
             'image.mimes'=>'Only allow jpg,png,jpeg,webp ',

             'name.max'=>'Maximum value of 50 ',
             'image.max'=>'Maximum image size 3 MB ',

             'name.min'=>'Minimum value of 3',
             'image.dimensions'=>'Image dimensions 612X408',
        ];

    public function generateSlug()
    {
        $this->slug = SlugService::createSlug(Category::class, 'slug', $this->name);
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    { 
       $this->validate();

        if ($this->branch == []) {
            // Show an error message if branch is required
            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Branch is required',
                'icon' => 'error',
            ]);
        } else {
            $check = Category::where('branch_id', $this->branch)->where('name', Str::lower($this->name))->count();

            if ($check > 0) {
                // Show a warning message if the category already exists for the branch
                $this->dispatchBrowserEvent('Swal', [
                    'title' => 'This branch already added this category.',
                    'icon' => 'warning',
                ]);
            } else {
                // Resize and encode the image
                $img = Image::make($this->image)->encode('webp');
                $img->resize(610, 610);
                $filename = Str::random() . '.webp';

                foreach ($this->branch as $key => $value) {
                    // Create a new category for each selected branch
                    $branch = Category::create([
                        'branch_id' => $value,
                        'name' => Str::title($this->name),
                        'slug' => $this->slug,
                        'image' => $filename,
                        'description' => Str::title($this->description),
                        'meta_title' => Str::title($this->name),
                        'meta_description' => Str::title($this->name),
                        'meta_keyword' => Str::title($this->name),
                    ]);
                }

                // Save the image to storage
                Storage::disk('public')->put($filename, $img);

                $this->dispatchBrowserEvent('Swal', [
                    'title' => 'Category Add Successfully',
                    'icon' => 'success',
                ]);

                // Reset input fields
                $this->resetinput();

                return redirect()->to('/control-area/categories');
            }
        }

    }

}
