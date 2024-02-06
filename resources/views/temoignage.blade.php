<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Témoignage</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body class="bg-body-tertiary">
    <div class="container">
        <div class="col-md-7 pt-4 mx-auto mb-5">
            @if (session('success'))
                <div class="alert alert-success fw-semibold" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card py-5 px-5">
                <form action="{{ route('add_temoignage')}}" method="post" class="px-1" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="mb-5">
                        <label class="mb-2 fw-bold text-uppercase">Titre *</label>
                        <input type="text" name="titre" class="form-control p-3 bg-body-secondary @error('titre') is-invalid @enderror"
                        value="{{old('titre')}}">
                        @error('titre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-5 d-flex flex-column">
                        <label class="mb-2 fw-bold text-uppercase">Image</label>
                        <input type="file" name="image" class="border-0 mb-2 @error('image') is-invalid @enderror" accept=".doc, .docx, .jpeg, .jpg, .png">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="mb-2 fw-bold text-uppercase">Message *</label>
                        <textarea name="message" class="form-control bg-body-secondary @error('message') is-invalid @enderror" cols="30" rows="5">{{old('message')}}</textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="submit" class="btn border-2 rounded-0 border-warning text-warning text-uppercase fw-bold px-4" value="add new testimonial">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if ($temoignages->isNotEmpty())
                <h2 class="text-center fw-bold mb-5">Testimonials</h2>
                @foreach ($temoignages as $temoignage)
                    <div class="col-lg-3 text-center mb-md-4 mb-lg-3">
                        <figure class="border mx-auto bg-white py-2 px-2 d-flex justify-content-center align-items-center">
                            <img src="{{asset('images/'.$temoignage->image)}}" class="rounded-circle" alt="{{$temoignage->titre}}" width="150">
                        </figure>
                        <p>{{$temoignage->titre}}</p>
                        <p class="description mt-0">{{$temoignage->message}}</p>
                    </div>                
                @endforeach                
            @endif
        </div>
    </div>
</body>
</html>