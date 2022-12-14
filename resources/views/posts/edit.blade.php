@extends('layouts.app')


@section('content')
    <header
        class="masthead"
        style="background-image: url('assets/img/home-bg.jpg')"
    >
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="container">

        <div class="col-md-6 mx-auto my-5">

            <div class="card shadow">
                <div class="card-body">

                    <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
                            @error('title') <span style="font-size: 14px;" class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>
                            @error('body') <span style="font-size: 14px;" class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            {{-- @error('image') <span style="font-size: 14px;" class="text-danger">{{$message}}</span> @enderror --}}
                        </div>

                        <button type="submit" class="btn btn-outline-primary w-100">Update Post</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection
