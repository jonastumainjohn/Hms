<div>
   
<div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a wire:click="selectTab('general_settings')" class="nav-link {{$tab == 'general_settings' ? 'active' : '' }}" data-toggle="tab" href="#general_settings" role="tab" aria-selected="false">General sattings</a>
            </li>
            <li class="nav-item">
                <a wire:click="selectTab('logo_favicon')"  class="nav-link {{$tab == 'logo_favicon' ?  'active' : '' }}" data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="true">Logo & Favicon</a>
            </li>
            
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{$tab == 'general_settings' ? 'active show' : '' }}" id="general_settings" role="tabpanel">
                <div class="pd-20">
                   <form wire:submit='updateSettingInfo()'>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site title</b></label>
                                <input type="text" class="form-control" wire:model="site_title" placeholder="Enter site title">
                                @error('site_title')
                                <span class="text-danger ml-1">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site email</b></label>
                                <input type="text" class="form-control" wire:model="site_email" placeholder="Enter site email">
                                @error('site_email')
                                <span class="text-danger ml-1">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site phone number</b><small>(optional)</small></label>
                                <input type="text" class="form-control" wire:model="site_phone" placeholder="Enter site phone">
                                @error('site_phone')
                                <span class="text-danger ml-1">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site Meta Keywords</b><small>(optional)</small></label>
                                <input type="text" class="form-control" wire:model="site_meta_keywords" placeholder="Eg: ecommerce, free api, larvel">
                                @error('site_meta_keywords')
                                <span class="text-danger ml-1">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for=""><b>Site Meta Description</b><small>(optional)</small></label>
                        <textarea class="form-control" cols="4" rows="4" wire:model="site_meta_description" placeholder="Type site meta description ..."></textarea>
                        @error('site_meta_description')
                        <span class="text-danger ml-1">{{$message}}</span>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                   </form>
                
                </div>
            </div>
            <div class="tab-pane fade {{$tab == 'logo_favicon' ? 'active show' : ''}}" id="logo_favicon" role="tabpanel">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-md-6">
                        <h6>Site Logo</h6>
                        <div class="mb-2 mt-1" style="max-width: 200px;">
                            <img 
                                src="/images/site/{{ settings()->site_logo ?? 'default-logo.jpg' }}" 
                                alt="" 
                                class="img-thumbnail" 
                                id="preview_site_logo" 
                                style="display: block; max-width: 100%;">
                        </div>


                        <form action="{{route('admin.update_logo')}}" method="post" enctype="multipart/form-data" id="updateLogoForm">
                            @csrf
                            <div class="mb-2">
                                <input type="file" name="site_logo" id="site_logo" class="form-control">
                                <span class="text-danger ml-1"></span>
                            </div>
                            <button type="submit" class="btn btn-success">Change Logo</button>
                        </form>
                        </div>

                        <div class="col-md-6">
                        <h6>Site Favicon</h6>
                            <div class="mb-2 mt-1" style="max-width: 100px;">
                                <img wire:ignore src="/images/site/{{ isset(settings()->site_favicon) ? settings()->site_favicon : 'default_favicon.png' }}" alt="Favicon" 
                                    class="img-thumbnail" 
                                    id="preview_site_favicon">
                            </div>
                            <form action="{{ route('admin.update_favicon') }}" method="post" enctype="multipart/form-data" id="updateFaviconForm"> 
                                @csrf 
                                <div class="mb-2">
                                    <input type="file" name="site_favicon" id="favicon_input" class="form-control">
                                    <span class="text-danger ml-1"></span>
                                </div>
                                <button type="submit" class="btn btn-success">Change favicon</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</div>
