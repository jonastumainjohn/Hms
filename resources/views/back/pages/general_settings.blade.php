@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : 'Page Title Here')
@section('content')
<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Settings</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="{{route('admin.dashboard')}}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Settings
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

                    <div class="pd-20 card-box mb-4">		
					@livewire('admin.settings')
					</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Define the notification function once
    function showNotification(message, isSuccess) {
    const notification = document.createElement('div');
    notification.innerText = message;
    notification.style.position = 'fixed';
    notification.style.top = '20px'; // Change this to 'top'
    notification.style.left = '50%'; // Center horizontally
    notification.style.transform = 'translateX(-50%)'; // Adjust for centering
    notification.style.padding = '10px';
    notification.style.backgroundColor = isSuccess ? 'green' : 'red';
    notification.style.color = 'white';
    notification.style.borderRadius = '5px';
    notification.style.zIndex = '1000'; // Ensure it's on top
    document.body.appendChild(notification);
    setTimeout(() => {
        document.body.removeChild(notification);
    }, 3000);
}

    $('#site_logo').change(function() {
        const file = this.files[0];
        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        const errorElement = $(this).siblings('span.text-danger');

        errorElement.text(''); // Clear previous error messages

        if (file) {
            // Validate file type
            if (!allowedExtensions.exec(file.name)) {
                errorElement.text('Invalid file type. Please select a PNG or JPG image.');
                $(this).val(''); // Clear the input
                $('#preview_site_logo').hide(); // Hide preview
                return;
            }

            // Preview the image
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    // Check dimensions
                    if (this.width < 500 || this.height < 149) {
                        errorElement.text('The logo must be at least 500x149 pixels.');
                        $('#preview_site_logo').hide(); // Hide preview
                    } else {
                        $('#preview_site_logo').attr('src', e.target.result).show(); // Show the preview
                    }
                };
            };
            reader.readAsDataURL(file);
        } else {
            errorElement.text('Please select an image file.');
            $('#preview_site_logo').hide(); // Hide preview if no file
        }
    });

    $('#updateLogoForm').submit(function(e) {
    e.preventDefault();
    var form = this;
    var inputVal = $(form).find('input[type="file"]').val();
    var errorElement = $(form).find('span.text-danger');
    errorElement.text('');

    if (inputVal.length > 0) {
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(data) {
                if (data.status == 1) {
                    $(form)[0].reset();
                    // Update the preview with the new logo
                    $('#preview_site_logo').attr('src', '/' + data.image_path).show(); // Show the updated preview
                    showNotification({ type: 'success', message: data.message });
                    $('img.site_logo').each(function() {
                        $(this).attr('src', '/' + data.image_path);
                    });
                } else {
                    showNotification({ type: 'error', message: data.message });
                }
            }
        });
    } else {
        errorElement.text('Please select an image file.');
    }
});

    // This is for favicon icon
    $('#favicon_input').change(function() {
        const file = this.files[0];
        const allowedExtensions = /(\.png|\.ico)$/i; // Only allow PNG or ICO
        const errorElement = $(this).siblings('span.text-danger');

        errorElement.text(''); // Clear previous error messages

        if (file) {
            // Validate file type
            if (!allowedExtensions.exec(file.name)) {
                errorElement.text('Invalid file type. Please select a PNG or ICO image.');
                $(this).val(''); // Clear the input
                $('#preview_site_favicon').hide(); // Hide preview
                return;
            }

            // Preview the image
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    // Check dimensions for favicon (must be square)
                    if (this.width !== this.height) {
                        errorElement.text('The favicon must be a square image (width must equal height).');
                        $('#favicon_input').val(''); // Clear the input
                        $('#preview_site_favicon').hide(); // Hide preview
                    } else if (this.width < 16 || this.height < 16) {
                        errorElement.text('The favicon must be at least 16x16 pixels.');
                        $('#favicon_input').val(''); // Clear the input
                        $('#preview_site_favicon').hide(); // Hide preview
                    } else {
                        $('#preview_site_favicon').attr('src', e.target.result).show(); // Show the preview
                    }
                };
            };
            reader.readAsDataURL(file);
        } else {
            errorElement.text('Please select an image file.');
            $('#preview_site_favicon').hide(); // Hide preview if no file
        }
    });

    $('#updateFaviconForm').submit(function(e) {
        e.preventDefault();
        var form = this;
        var inputVal = $(form).find('input[type="file"]').val();
        var errorElement = $(form).find('span.text-danger');
        errorElement.text('');

        if (inputVal.length > 0) {
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {
                        $(form)[0].reset();
                        $('#preview_site_favicon').hide();
                        $('#preview_site_favicon').attr('src', '/' + data.image_path).show();
                        showNotification({ type: 'success', message: data.message });

                        // Update favicon link in the head with cache-busting
                        $('link[rel="icon"]').attr('href', '/' + data.image_path + '?t=' + new Date().getTime());
                    } else {
                        showNotification({ type: 'error', message: data.message });
                    }
                },
                error: function(xhr, status, error) {
                    showNotification({ type: 'error', message: 'An error occurred. Please try again.' });
                }
            });
        } else {
            errorElement.text('Please select an image file.');
        }
    });
});
</script>


@endpush