<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Testimonial</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body class="bg-body-tertiary">
    <div class="container">
        <div class="col-md-7 pt-3 mx-auto mb-5">
            <div class="card py-5 px-5">
                <form action="{{ route('update_temoignage',$temoignage->id)}}" method="post" class="px-1" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-5">
                        <label class="mb-2 fw-bold text-uppercase">Titre *</label>
                        <input type="text" name="titre" class="form-control p-3 bg-body-secondary @error('titre') is-invalid @enderror"
                        value="{{old('titre',$temoignage->titre)}}">
                        @error('titre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-5 d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <label class="mb-2 fw-bold text-uppercase">Image</label>
                            <input type="file" name="image" class="border-0 mb-2 @error('image') is-invalid @enderror" accept=".doc, .docx, .jpeg, .jpg, .png">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if($temoignage->image)
                            <div>
                                <img src="{{asset("images/".$temoignage->image)}}" alt="" width="50">
                            </div>                            
                        @endif
                    </div>
                    <div class="mb-5">
                        <label class="mb-2 fw-bold text-uppercase">Message *</label>
                        <textarea name="message" class="form-control bg-body-secondary @error('message') is-invalid @enderror" cols="30" rows="5">{{old('message',$temoignage->message)}}</textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="mb-2 fw-bold text-uppercase">Statut *</label>
                        <select class="form-select @error('statut') is-invalid @enderror" name="statut">
                            <option {{old('statut') === 'en attente' || $temoignage->statut === "en attente"? "selected":""}} value="en attente">en attente</option>
                            <option {{old('statut') === 'approuvé' || $temoignage->statut === "approuvé"? "selected":""}} value="approuvé">approuvé</option>
                            <option {{old('statut') === 'rejeté' || $temoignage->statut === "rejeté"? "selected":""}} value="rejeté">rejeté</option>
                        </select>
                        @error('statut')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="submit" class="btn border-2 rounded-0 border-warning text-warning text-uppercase fw-bold px-4" value="update testimonial">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>