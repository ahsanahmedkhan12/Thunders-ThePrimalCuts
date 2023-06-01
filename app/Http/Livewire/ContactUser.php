<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Str;
class ContactUser extends Component
{
    public $name, $email, $phone, $subject, $message ;  

    public function render()
    {
        return view('livewire.contact-user');
    }
   
  public function resetinput(){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->subject = '';
        $this->message = '';
    }

    protected $rules = [
        'name'=>['required','regex:/^[a-zA-Z0-9\s]*$/','max:50','min:3'],
        'email'=>['required','email', 'max:50','min:10'],
        'phone'=>['required' , 'regex:/^(\(\d{3}\))[\s]\d{3}[\s\-]?\d{4}$/'],
        'subject'=>['required' , 'regex:/^[a-zA-Z0-9\s\&\,\-\(\)\%\;\:\#\$\*\!]*$/','max:250','min:3'],
        'message'=>['required' , 'regex:/^[a-zA-Z0-9\s\&\,\-\(\)\%\;\:\#\$\*\!]*$/','max:250','min:3'],
    ];
    protected $messages = [
            'name.required'=>'This name  is required ',
            'image.required'=>'This image  is required ',
            'phone.required'=>'This phone  is required ',
            'subject.required'=>'This subject  is required ',
            'message.required'=>'This message  is required ',

            'name.regex'=>'Only allow Alphabet , Number and Space ',
            'phone.regex'=>'The phone format is invalid (Ex: (111) 111-1111).',
            'email.email'=>'Please enter a valid email address (Ex: johndoe@domain.com).',
            'subject.regex'=>'Only allow a-z A-Z 0-9 space &,-()%;:#$*!',
            'message.regex'=>'Only allow a-z A-Z 0-9 space &,-()%;:#$*!',
            
            'name.max'=>'Maximum value of 50 ',
            'subject.max'=>'Maximum value of 250 ',
            'message.max'=>'Maximum value of 250 ',

            'name.min'=>'Minimum value of 3',
            'subject.min'=>'Minimum value of 3',
            'message.min'=>'Minimum value of 3',
        ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    { 
        $this->validate();
        $branch = Contact::create([
            'name' => Str::title($this->name),
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);
               


        $this->dispatchBrowserEvent('Swal',[
            'title'=>'Your contact detail and message send to the management',
            'icon'=>'success',

        ]);
        $this->resetinput();

        
    }
}

