@extends('layouts.new')

@section('style')
    <style>
        .mce-notification-warning {display: none;}
    </style>
@endsection

@section('content')

    <div class="container">
        <form action="{{ route('pages.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="page_content">Название:</label>
                <input type="text" class="form-control" name="name">
                <label for="page_content">Контент:</label>
                <textarea id="page_content" name="page_content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection

@section('footer')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({
            width: '100%',
            height: 300,
            selector:'textarea#page_content',
            // plugins: [
            //     "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            //     "searchreplace wordcount visualblocks visualchars code fullscreen",
            //     "insertdatetime media nonbreaking save table contextmenu directionality",
            //     "emoticons template paste textcolor colorpicker textpattern"
            // ],
            {{--images_upload_handler: function (blobInfo, success, failure) {--}}
                {{--var xhr, formData;--}}
                {{--xhr = new XMLHttpRequest();--}}
                {{--xhr.withCredentials = false;--}}
                {{--xhr.open('POST', '{{ route('image-upload') }}');--}}
                {{--var token = document.getElementById("_token").value;--}}
                {{--xhr.setRequestHeader("X-CSRF-Token", token);--}}
                {{--xhr.onload = function() {--}}
                    {{--var json;--}}
                    {{--if (xhr.status != 200) {--}}
                        {{--failure('HTTP Error: ' + xhr.status);--}}
                        {{--return;--}}
                    {{--}--}}
                    {{--json = JSON.parse(xhr.responseText);--}}

                    {{--if (!json || typeof json.location != 'string') {--}}
                        {{--failure('Invalid JSON: ' + xhr.responseText);--}}
                        {{--return;--}}
                    {{--}--}}
                    {{--success(json.location);--}}
                {{--};--}}
                {{--formData = new FormData();--}}
                {{--formData.append('file', blobInfo.blob(), blobInfo.filename());--}}
                {{--xhr.send(formData);--}}
            {{--},--}}
            {{--file_picker_callback: function(cb, value, meta) {--}}

                {{--var input = document.createElement('input');--}}
                {{--input.setAttribute('type', 'file');--}}
                {{--input.setAttribute('accept', 'image/*');--}}
                {{--input.onchange = function() {--}}
                    {{--var file = this.files[0];--}}
                    {{--var id = 'blobid' + (new Date()).getTime();--}}
                    {{--var blobCache = tinymce.activeEditor.editorUpload.blobCache;--}}
                    {{--var blobInfo = blobCache.create(id, file);--}}
                    {{--blobCache.add(blobInfo);--}}
                    {{--cb(blobInfo.blobUri(), { title: file.name });--}}
                {{--};--}}
                {{--input.click();--}}
            {{--}--}}
        });
    </script>
@endsection