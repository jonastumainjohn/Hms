@extends('back.layout.pages-layout')

@section('pageTitle', $pageTitle ?? 'Page Title Here')

@section('content')
    <div class="page-header">
        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header and Breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

   <!-- Profile Component Wrapper -->
    @livewire('admin.profile')

@endsection

@push('scripts')
<script>
    // Function to show notifications
    function showNotification(message, isSuccess) {
        const notification = document.createElement('div');
        notification.innerText = message;
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.left = '50%';
        notification.style.transform = 'translateX(-50%)';
        notification.style.padding = '10px';
        notification.style.backgroundColor = isSuccess ? 'green' : 'red';
        notification.style.color = 'white';
        notification.style.borderRadius = '5px';
        notification.style.zIndex = '1000';
        document.body.appendChild(notification);

        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    }

    // Profile picture upload handler
    $('input[type="file"][id="profilePictureFile"]').Kropify({
        preview: 'image#profilePicturePreview',
        viewMode: 1,
        aspectRatio: 1,
        cancelButtonText: 'Cancel',
        resetButtonText: 'Reset',
        cropButtonText: 'Crop & update',
        processURL: '{{ route("admin.update_profile_picture") }}',
        maxSize: 2097152,
        showLoader: true,
        success: function(data) {
            if (data.status == 1) {
                Livewire.dispatch('updateTopUserInfo');
                Livewire.dispatch('updateProfile');
                $('#profilePicturePreview').attr('src', data.newPictureUrl);
                showNotification(data.message, true);
            } else {
                showNotification(data.message, false);
            }
        },
        errors: function(error, text) {
            console.log(text);
            showNotification('An error occurred while processing your request.', false);
        },
    });
</script>
@endpush
