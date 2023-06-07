<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Branch;
use App\Models\BranchTime;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\WeekDay;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;
use Image;
use Str;
class AddEditBranch extends Component
{
    use WithFileUploads;
    public $titlename, $name , $image , $phone , $address , $slug, $weekday=[],$starttime,$closetime;
    public function render()
    {
       
        return view('livewire.add-edit-branch');
    }

    public function resetinput(){
        $this->name = '';
        $this->image = '';
        $this->phone = '';
        $this->address = '';
        $this->slug = '';
        $this->weekday = []; 
        $this->starttime = '';
        $this->closetime = '';

    }

    public function mount($id=null){
       $this->weekdaydata = WeekDay::orderBy('position', 'asc')->get();
       if($id == null){
            $this->titlename = "Add Branch";

       }else{

          $this->titlename = "Edit Branch";
       }
    }

    protected $rules = [
        'name'=>['required','regex:/^[a-zA-Z0-9\s]*$/','max:50','min:3','unique:branches,name'],
        'image'=>['required','mimes:jpg,png,jpeg,webp','max:3000','dimensions:width=570,height=300'],
        'phone'=>['required','max:17','min:14','unique:branches,phone'],
        'address'=>['required','regex:/^[a-zA-Z0-9\s\-\,\.\&\(\)]*$/','max:255','min:10'],
        'starttime'=>['required'],
        'closetime'=>['required'],
    ];
    protected $messages = [
             'name.required'=>'This name  is required ',
             'image.required'=>'This image  is required ',
             'phone.required'=>'This phone  is required ',
             'address.required'=>'This address  is required ',

             'name.regex'=>'Only allow Alphabet , Number and Space ',
             'image.mimes'=>'Only allow jpg,png,jpeg,webp ',
            
             'address.regex'=>'Only allow Alphabet , Number and Space -,.() ',

             'name.max'=>'Maximum value of 50 ',
             'image.max'=>'Maximum image size 3 MB ',
             'phone.max'=>'Maximum value of 15 ',
             'address.max'=>'Maximum value of 255 ',

             'name.min'=>'Minimum value of 3',
             'image.dimensions'=>'Image dimensions 570X300',
             'phone.min'=>'Minimum value of 14',
             'address.min'=>'Minimum value of 20',
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
    // Validate the form data
    $this->validate();

    // Check if the weekday is not selected
    if ($this->weekday == []) {
        $this->dispatchBrowserEvent('Swal',[
            'title'=>'Week Day is required',
            'icon'=>'error',
        ]);
    } else {
        // Process the image
        $img   = Image::make($this->image)->encode('webp');
        $img->resize(570, 300);
        $filename  = Str::random() . '.webp';

        // Create a new branch record
        $branch = Branch::create([
            'name' => Str::title($this->name),
            'slug'  => $this->slug,
            'image' => $filename,
            'phone' => $this->phone,
            'address' => $this->address,
            'meta_title' => Str::title($this->name),
            'meta_description'  => Str::title($this->name),
            'meta_keyword' => Str::title($this->name),
        ]);

        // Store the image file
        Storage::disk('public')->put($filename, $img);

        // Create branch time records for selected weekdays
        foreach ($this->weekday as $key => $value) {
            $branchtime = BranchTime::create([
                'branch_id' => $branch->id,
                'weekday_id' => $value,
                'start_time' => $this->starttime,
                'stop_time' => $this->closetime,
                'position' => $key
            ]);
        }

        // Display success message
        $this->dispatchBrowserEvent('Swal',[
            'title'=>'Branch Add Successfully',
            'icon'=>'success',
        ]);

        // Reset the input fields and redirect to the branches page
        $this->resetinput();
        return redirect()->to('/control-area/branches');
    }
   
}
 protected function cleanupOldUploads()
    {
        $storage = Storage::disk('local');

        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {

            if (! $storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->subSeconds(4)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }

    // public function submit()
    // { 
    //     $this->validate();
    //     if($this->weekday == []){
    //        $this->dispatchBrowserEvent('Swal',[
    //             'title'=>'Week Day is required',
    //             'icon'=>'error',
    //         ]);

    //     }else{
     
    //     $img   = Image::make($this->image)->encode('webp');
    //     $img->resize(570, 300);
    //     $filename  = Str::random() . '.webp';

    //     $branch = Branch::create([
    //         'name' => Str::title($this->name),
    //         'slug'  => $this->slug,
    //         'image' => $filename,
    //         'phone' => $this->phone,
    //         'address' => $this->address,
    //         'meta_title' => Str::title($this->name),
    //         'meta_description'  => Str::title($this->name),
    //         'meta_keyword' => Str::title($this->name),
    //     ]);
    //     Storage::disk('public')->put($filename, $img);
    //         foreach ($this->weekday as $key => $value) {
    //             $branchtime = BranchTime::create([
    //                 'branch_id' => $branch->id,
    //                 'weekday_id' => $value,
    //                 'start_time' => $this->starttime,
    //                 'stop_time' => $this->closetime,
    //                 'position' => $key
    //             ]);
    //         }            


    //     $this->dispatchBrowserEvent('Swal',[
    //         'title'=>'Branch Add Successfully',
    //         'icon'=>'success',

    //     ]);
    //     $this->resetinput();
    //     return redirect()->to('/control-area/branches');
    //    }
        
    // }
}
