@extends('admin.home')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">


            <h5>Add Event</h5>

        </nav>
    </div>
    <div class="info row " style="display: flex;justify-content: center;">

        <form class="w-50" id="upload-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                    placeholder="Enter name" name="name">

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Content</label>
                <input type="text" class="form-control" id="exampleInputContent" aria-describedby="ContentHelp"
                    placeholder="Enter Content" name="content">

            </div>


            <div class="form-group col-md-6">
                <label for="inputPassword4">Image</label>
                <input type="file" class="form-control file" placeholder="Image" name="file" id="file">
                <input type="hidden" name="filetmp" id="filetmp">
            </div>







            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Laravel Cropper Js - Crop Image Before Upload - Tutsmake.com
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-4">
                                    <img id="image" src="">
                                </div>
                                <div class="col-md-1">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            $('#upload-form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('events.confirmEvent') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'Json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data1) {

                        localStorage.setItem('name', data1.name);
                        localStorage.setItem('content', data1.content);
                        localStorage.setItem('image', data1.image);


                        function setCookie(name, value, days) {
                            var expires = "";
                            if (days) {
                                var date = new Date();
                                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                                expires = "; expires=" + date.toUTCString();
                            }
                            document.cookie = name + "=" + (value || "") + expires + "; path=/";
                        }

                        //get your item from the localStorage
                        var name = localStorage.getItem('name');
                        var content = localStorage.getItem('content');
                        var image = localStorage.getItem('image');
                        setCookie('name', name, 1);
                        setCookie('content', content, 1);
                        setCookie('image', image, 1);

                        alert(image);



                        window.location.href = "{{ route('events.confirmEvent1') }}";

                    }
                })
            })
        })

        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".file", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 100,
                height: 100,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#filetmp').val(base64data);
                }
            });
        })
    </script>



@endsection
