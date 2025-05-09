<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8y+z5l5e5c5e5c5e5c5e5c5e5c5e5c5e5c5" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="stylesheet" href="{{asset('css/main.css')}}">

<body >
    <div class="container">
        <h1 class="text-white mt-5">Create Course</h1>
        <form id="saveCourse" enctype="multipart/form-data">
            @csrf
            
        <div class="row">
            <div class="card course">
             <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label fs-3 text-gray">Course Title</label>
                    <input type="text" class="form-control" name="title" id="" placeholder="Course Title" aria-describedby="helpId">
                </div>
                <div class="col-md-6">
                <label for="" class="form-label fs-3 text-gray">Feature Video</label>
                <input type="text" class="form-control" name="feature_video" id="" placeholder="Feature Video" aria-describedby="helpId">
                </div>
                <hr>
                <div class="col-2">
                <a  class="btn btn-primary add_module"><span class="me-2">Add Module</span><i class="fas fa-plus"></i></a>
                </div>
               <div class="col-12 card module mt-2">

               </div>
             </div>

             <div class="col-md-4 mt-3">
                <a class="btn btn-success border-rounded mt-3 save">Save</a>
                <a class="btn btn-danger mt-3 cancel">Cancel</a>
            </div>
            </div>



        </div>
        </form>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>

$(document).on('click','.cancel',function(e){
    e.preventDefault();
    $('#saveCourse')[0].reset();
    $('.module').html('');
});


   $(document).on('click', '.add_module', function(e) {
    e.preventDefault();
    let moduleCount = $('.module-item').length ;
    $('.module').append(`
        <div class="accordion accordion-flush module-item" id="moduleAccordion${moduleCount}" data-index="${moduleCount}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading${moduleCount}">
                    <div class="d-flex justify-content-between align-items-center w-100" style="background-color: #1e293b; border: 1px solid #ccc;">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${moduleCount}" aria-expanded="false" aria-controls="collapse${moduleCount}" style="background-color: #3a4b4c; color: #ffffff;">
                            Module ${moduleCount+1}
                        </button>
                        <button class="btn btn-danger btn-remove">x</button>
                    </div>
                </h2>
                <div id="collapse${moduleCount}" class="accordion-collapse collapse" aria-labelledby="heading${moduleCount}" >
                    <div class="accordion-body" style="background-color: #1e293b;">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="module_title_${moduleCount}" class="form-label fs-3 text-gray">Module Title</label>
                                <input type="text" class="form-control" name="module_title[]" id="module_title_${moduleCount}" placeholder="Module Title" aria-describedby="helpId">
                            </div>
                            <div class="col-2 mt-2">
                                <a class="btn btn-primary add_content"><span class="me-2" >Add Content</span><i class="fas fa-plus"></i></a>
                            </div>
                            <div class="col-12 card content mt-2" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);

    $('.btn-remove').off('click').on('click', function() {
        $(this).closest('.module-item').remove();
    });
});

$(document).on('click', '.add_content', function(e) {
            e.preventDefault();
            let module = $(this).closest('.module-item');
            let moduleIndex = module.data('index');
            let countcontent = module.find('.content-item').length ;
            module.find('.content').fadeIn();
            module.find('.content').append(`
                <div class="accordion accordion-flush content-item card" id="contentAccordion_${moduleIndex}_${countcontent}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingContent_${moduleIndex}_${countcontent}">
                            <div class="d-flex justify-content-between align-items-center w-100" style="background-color: #1e293b; border: 1px solid #ccc;">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent_${moduleIndex}_${countcontent}" aria-expanded="false" aria-controls="collapseContent_${moduleIndex}_${countcontent}" style="background-color: #3a4b4c; color: #ffffff;">
                                    Content 
                                </button>
                                <button class="btn btn-danger btn-remove-content">x</button>
                            </div>
                        </h2>
                        <div id="collapseContent_${moduleIndex}_${countcontent}" class="accordion-collapse collapse" aria-labelledby="headingContent_${moduleIndex}_${countcontent}">
                            <div class="accordion-body" style="background-color: #1e293b;">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="content_title_${moduleIndex}_${countcontent}" class="form-label fs-3 text-gray">Content Title</label>
                                        <input type="text" class="form-control" name="content[${moduleIndex}][${countcontent}][content_title]" id="content_title_${moduleIndex}_${countcontent}" placeholder="Content Title" aria-describedby="helpId">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="video_source_type_${moduleIndex}_${countcontent}" class="form-label fs-3 text-gray">Video Source Type</label>
                                        <select class="form-control" name="content[${moduleIndex}][${countcontent}][video_source_type]" id="video_source_type_${moduleIndex}_${countcontent}">
                                            <option value="" selected disabled>Choose...</option>
                                            <option value="url">URL</option>
                                            <option value="upload">Upload</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="video_url_${moduleIndex}_${countcontent}" class="form-label fs-3 text-gray">Video URL</label>
                                        <input type="text" class="form-control" name="content[${moduleIndex}][${countcontent}][video_url]" id="video_url_${moduleIndex}_${countcontent}" placeholder="Enter Video URL" aria-describedby="helpId">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="video_length_${moduleIndex}_${countcontent}" class="form-label fs-3 text-gray">Video Length</label>
                                        <input type="text" class="form-control" name="content[${moduleIndex}][${countcontent}][video_length]" id="video_length_${moduleIndex}_${countcontent}" placeholder="HH:MM:SS" aria-describedby="helpId">
                                    </div>

                                  <div class="col-md-12">
                                        <label for="Image${moduleIndex}_${countcontent}" class="form-label fs-3 text-gray">Thumbnail Image</label>
                                        <input type="file" class="form-control" name="content[${moduleIndex}][${countcontent}][image]" id="video_length_${moduleIndex}_${countcontent}" placeholder="HH:MM:SS" aria-describedby="helpId">
                                    </div>

                                  <div class="col-md-12">
                                        <label for="Image${moduleIndex}_${countcontent}" class="form-label fs-3 text-gray">Upload Video</label>
                                        <input type="file" class="form-control" name="content[${moduleIndex}][${countcontent}][video]" id="video_length_${moduleIndex}_${countcontent}" placeholder="HH:MM:SS" aria-describedby="helpId">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            $('.btn-remove-content').off('click').on('click', function() {
                $(this).closest('.content-item').remove();
            });
        });


function validateForm() {
    
    $('.text-danger').remove();

    let isvalid = true;

    let title = $('input[name="title"]').val();
    if (title === '') {
        $('input[name="title"]').after('<span class="text-danger">Title is required</span>');
        isvalid = false;
    }

    let feature_video = $('input[name="feature_video"]').val();
    if (feature_video === '') {
        $('input[name="feature_video"]').after('<span class="text-danger">Feature video is required</span>');
        isvalid = false;
    }

            $('input[name$="[video_url]"]').each(function () {
                let value = $(this).val().trim();
                let urlPattern = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/;
               if(value!==''){
               if (!urlPattern.test(value)) {
                    $(this).after('<span class="text-danger">Invalid URL format</span>');
                    isvalid = false;
                }
            }
            });


            $('input[name$="[video_length]"]').each(function () {
                let value = $(this).val().trim();
                let timePattern = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/; // HH:MM:SS

             if(value!==''){
                if (!timePattern.test(value)) {
                    $(this).after('<span class="text-danger">Invalid time format (HH:MM:SS)</span>');
                    isvalid = false;
                }

            }
            });




    $('input[name="module_title[]"]').each(function () {
        if ($(this).val().trim() === '') {
            $(this).after('<span class="text-danger">Module title is required</span>');
            isvalid = false;
        }
    });

  
    $('input[name$="[content_title]"]').each(function () {
        if ($(this).val().trim() === '') {
            $(this).after('<span class="text-danger">Content title is required</span>');
            isvalid = false;
        }
    });

    $('select[name$="[video_source_type]"]').each(function () {
        // alert($(this).val());
        if ($(this).val() ===null) {
            $(this).after('<span class="text-danger">Video source type is required</span>');
            isvalid = false;
        }
    });

    return isvalid;
}




        $(document).on('click','.save',function(e){
            if (!validateForm()) {
        return; 
    }
        e.preventDefault();
        let formData = new FormData($('#saveCourse')[0]);
        $.ajax({

            url:"{{ route('course.store') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status===200){
                    toastr.success("Course Created Successfully");
                    $('#saveCourse')[0].reset();
                    location.reload();
                }
            },
            error: function(xhr) {
    $('.text-danger').remove();

    if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;

        $.each(errors, function(field, messages) {
            let selector;

            
            if (field.startsWith('module_title.')) {
                selector = 'input[name="module_title[]"]';
            }
          
            else {
                let inputName = field.replace(/\.(\d+)/g, '[$1]').replace(/\.(\w+)/g, '[$1]');
                selector = `[name="${inputName}"]`;
            }

            if ($(selector).length > 0) {
                $(selector).first().after(`<span class="text-danger">${messages[0]}</span>`);
            } else {
                console.warn('Input not found for field:', field, '-> Selector:', selector);
            }
        });
    } else {
        alert('An unexpected error occurred.');
        console.error(xhr.responseText);
    }
}



        });
    });

</script>
</body>
</html>