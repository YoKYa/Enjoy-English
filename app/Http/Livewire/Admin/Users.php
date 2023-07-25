<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{Auth, Validator};

class Users extends Component
{
    // All users
    public $users;
    // Modal
    public $editUserModal = false;
    public $deleteUserModal = false;
    // Selected User
    public $selectedUser;
    public $userId;
    public $name;
    public $email;
    public $class;
    public $roles;

    // Constructor
    public function mount()
    {
        if (Auth::user()->roles == 'user') {
            redirect('dashboard');
        }
    }
    public function render()
    {
        $this->updateUser();
        return view('livewire.admin.users');
    }

    // Edit User
    public function updateUser() {
        $this->users = User::where('roles','!=','superadmin')->orderBy('name', 'Asc')->get();
    }
    public function editUser(User $user){
        $this->modalEdit();
        $this->selectedUser = $user;
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->class = $user->class;
        $this->roles = $user->roles;
    }
    public function confirmUpdateUser(){
        $update = Validator::make([
            "name"      =>  $this->name,
            "email"     =>   $this->email,
            "class"     =>   $this->class,
            "roles"     => $this->roles
        ], [
            'name' => ['required', 'string', 'max:255'],
            'class' => ['string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'roles' => ['required']
        ])->validateWithBag('updateUserInformation');
        $this->selectedUser->forceFill($update)->save();
        session()->flash('message', 'User successfully updated.');
        $this->resetErrorBag();
        $this->modalEdit();
        $this->updateUser();
    }
    

    // Delete User
    public function deleteUser(User $user){
        $this->modalDelete();
        $this->selectedUser = $user;
    }
    public function confirmDeleteUser(){
        $this->selectedUser->delete();
        session()->flash('message', 'User successfully deleted.');
        $this->modalDelete();
        $this->updateUser();
    }
    // Modal
    public function modalEdit(){
        $this->editUserModal = !$this->editUserModal; 
    }
    public function modalDelete(){
        $this->deleteUserModal = !$this->deleteUserModal; 
    }

}
