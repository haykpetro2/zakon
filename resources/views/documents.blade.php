@extends('layouts.main')

@section('header')

@endsection

@section('content')

<div class="content my_documents">
    <div class="page_title">
        <div class="col-md-9 offset-md-3">
            <h1 class="f-60">Мои документы</h1>
        </div>
    </div>

    <div class="container-fluid mydocs_main">
        <div class="row h-100 mydocs_cols">
            <div class="col-md-3">
                <div class="uploaded_doc_list">
                    <ul class="docuemnt_years">
                        <li><a href="{{ route('documents', $id) }}" class="f-30">Загруженные документы</a></li>
                        @foreach($years as $i => $year)
                            <li @if(isset($_GET['year']) && $_GET['year'] == $i) {{ 'class=active'  }}@endif><a href="?year={{$i}}">{{ $i }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="my_docs">
                    <div class="row h-100">
                        <div class="col-md-5 my_docs_block pt-5">
                            <div class="row h-90">
                                @foreach($documents as $document)
                                    <div class="col-md-4 col-sm-4 text-center">
                                        <img src="{{ asset('images/single_document_image.png') }}" alt="Single Document" class="document_image">
                                        <a href="{{ asset('storage/documents/'.$document->document_file) }}"><p>{{ $document->document_name }}</p></a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center mb-3 add_document_block">
                                <a href="" data-target="#documentUpload" data-toggle="modal" class="f-30">Добавить документ</a>
                            </div>
                        </div>
                        <div class="col-md-7">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal" id="documentUpload">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Загрузить документ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('upload-document') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" placeholder="Название файла" class="change_settings" name="document_name" required>

                    <select name="category" id="document_categories">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                    </select>

                    <input type="file" placeholder="Введите новый логин" class="mt-3 d-block" name="document_file" required>

                    <input type="hidden" name="user_id" value="{{ $id }}">

                    <input type="submit" value="Загрузить" class="upload_close mt-3">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="upload_close" data-dismiss="modal">Закрыть</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('footer')

@endsection