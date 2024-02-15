@extends('front')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Timeline</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Timeline</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (session('alert'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline item -->
                        @foreach ($galery as $item)
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i>
                                        {{ $item->created_at->diffForHumans() }}</span>
                                    {{-- <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                        email</h3> --}}
                                    <a href="{{ asset('img/' . $item->foto) }}" data-toggle="lightbox"
                                        data-title="{{ $item->foto }}" data-gallery="gallery">
                                        <img src="{{ asset('img/' . $item->foto) }}" class="py-5 d-block m-auto"
                                            height="500" alt="">
                                    </a>
                                    <div class="timeline-body">
                                        <h4>{{ $item->judul }}</h4>
                                        {{ $item->deskripsi }}
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-update{{ $item->id }}">Update</a>
                                        <a href="{{ url('timeline/' . $item->id) }}"
                                            onclick="return confirm('Yakin untuk dihapus??')"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                    <div class="modal fade" id="modal-update{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Upload</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ url('timeline/' . $item->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->judul }}" maxlength="100" name="judul"
                                                                placeholder="Judul">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsi">{{ $item->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="file" name="foto"
                                                                id="updateImage{{ $item->id }}">
                                                        </div>
                                                        <div class="form-group">
                                                            @if ($item->foto)
                                                                <img src="{{ 'img/' . $item->foto }}"
                                                                    style="width: 100%; height:100%; max-height:200px; max-width:150px"
                                                                    id="updatePreview{{ $item->id }}">
                                                            @else
                                                                <img style="width: 100%; height:100%; max-height:200px; max-width:150px"
                                                                    id="updatePreview{{ $item->id }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- END timeline item -->
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->

    </section>
    <!-- /.content -->
@endsection
