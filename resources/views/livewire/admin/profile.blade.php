

<!-- Livewire Profile Section -->
<div>
    <div class="row">
        <!-- Profile Photo Section -->
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="javascript:;" 
                        onclick="event.preventDefault();document.getElementById('profilePictureFile').click();" 
                        class="edit-avatar" 
                        id="profilePicturePreview">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <img 
                        src="{{ $user->picture }}" 
                        alt="User Picture" 
                        style="border-radius: 78px;" 
                        onerror="this.onerror=null; this.src='{{ asset('images/users/default-avatar.jpg') }}';" />
                    <input 
                        type="file" 
                        name="profilePictureFile" 
                        id="profilePictureFile" 
                        class="d-none" 
                        style="opacity: 0;">
                </div>

                <h5 class="text-center h5 mb-0">{{ $user->name }}</h5>
                <p class="text-center text-muted font-14">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Profile Details Section -->
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden p-4">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <!-- Navigation Tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a wire:click="selectTab('personal_details')" 
                                    class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}" 
                                    data-toggle="tab" 
                                    href="#personal_details" 
                                    role="tab">
                                    Personal Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:click="selectTab('update_password')" 
                                    class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}" 
                                    data-toggle="tab" 
                                    href="#update_password" 
                                    role="tab">
                                    Update Password
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Contents -->
                        <div class="tab-content">
                            <!-- Personal Details Tab -->
                            <div class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}" 
                                id="personal_details" 
                                role="tabpanel">
                                <form wire:submit.prevent="updatePersonalDetails()" class="w-100">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="full-name">Full Name</label>
                                                <input 
                                                    type="text" 
                                                    id="full-name" 
                                                    class="form-control" 
                                                    wire:model="name" 
                                                    placeholder="Enter full name">
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input 
                                                    type="email" 
                                                    id="email" 
                                                    class="form-control" 
                                                    wire:model="email" 
                                                    placeholder="Enter email address" 
                                                    disabled>
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input 
                                                    type="text" 
                                                    id="username" 
                                                    class="form-control" 
                                                    wire:model="username" 
                                                    placeholder="Enter username">
                                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Update Password Tab -->
                            <div class="tab-pane fade {{ $tab == 'update_password' ? 'show active' : '' }}" 
                                id="update_password" 
                                role="tabpanel">
                                <form wire:submit.prevent="updatePassword()">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="current_password">Current Password</label>
                                                <input 
                                                    type="password" 
                                                    id="current_password" 
                                                    class="form-control" 
                                                    wire:model="current_password" 
                                                    placeholder="Enter current password">
                                                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input 
                                                    type="password" 
                                                    id="new_password" 
                                                    class="form-control" 
                                                    wire:model="new_password" 
                                                    placeholder="Enter new password">
                                                @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="new_password_confirmation">Confirm New Password</label>
                                                <input 
                                                    type="password" 
                                                    id="new_password_confirmation" 
                                                    class="form-control" 
                                                    wire:model="new_password_confirmation" 
                                                    placeholder="Confirm new password">
                                                @error('new_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update Password</button>
                                </form>
                            </div>
                        </div>
                        <!-- End of Tab Content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Profile Details Section -->
    </div>
</div>
