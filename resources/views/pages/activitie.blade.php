@extends('layouts.app')

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Activities</title>
  <link rel="icon" href="{{ asset('images/ic.png') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font awesome link (Lien externe pour les icones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
          <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* .active_container{
            display: none;
        } */
    </style>
</head>
<body>
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success" style="text-align: center;">
            {{ Session::get('message') }}
        </div>
    @endif

    @if(Session::has('status'))
        <div class="alert alert-success" style="text-align: center;">
            {{ Session::get('status') }}
        </div>
    @endif
<a href="{{ url('home') }}">Accueil</a>
    <div>
        <div class="float-end">
            <form class="d-flex" action="{{ '/activitie' }}" method="GET">
            <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ request()->query('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <p style="text-align: center; font-family: new time roman;">ACTIVITIES REGISTRATION</p>
        <hr>
    </div>
    <div class="container" id="id01">
        <div class="col-mt-10">
                <div class="container-fluid h-custom">
                        <br>
                        <br>
                      <form action="{{url('/activitie')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name_activities">Name activities:</label>
                            <input type="text" class="form-control @error('name_activities') is-invalid @enderror" id="name_activities" placeholder="Enter name activitie" name="name_activities" required>
                            @error('name_activities')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image_activitie">Image:</label>
                            <input type="file" class="form-control" id="image_activitie" name="image_activitie" required>
                        </div>

                        <div class="mb-3">
                            <label for="activities">Activities:</label>
                            <textarea class="form-control @error('activities') is-invalid @enderror" placeholder="Enter text" id="activities"  rows="7" name="activities" required></textarea>
                            @error('activities')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-success btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="save">Save</button>
                          <br>

                        </div>

                      </form>
                  </div>
                </div>
        </div>
    </div>
    <br>

            <div id="test_activitie" class="container active_container">
                <div class="col-mt-8">
                    <table class="table table-hover" style="border: 1px">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Name Activitie</th>
                                <th>Image</th>
                                <th>Activitie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activities as $activitie)
                            <tr>
                                <td>{{ $activitie->id }}</td>
                                <td>{{ $activitie->name_activities }}</td>
                                <td><img src="../pictures_activities/{{ $activitie->image_activitie }}" style=" width: 40px; height: 40px; background: black; border-radius: 50%;"></td>
                                <td>{{ substr( $activitie->activities ,0, 170)}}... </td>
                                <td>
                                    <a href="{{ url('/activitieUpdate', $activitie->id) }}"class="btn btn-sm btn-primary rounded-0"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            @empty
                            <p class="text-center">
                                No result found for query <strong>{{ request()->query('search') }}</strong>
                            </p>
                            @endforelse
                        </tbody>
                    </table>
                    <div style="margin-left: 45%">
                        {{ $activities->appends(['search' => request()->query('search')])->links() }}
                    </div>
                </div>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>



@endsection

</body>
</html>
