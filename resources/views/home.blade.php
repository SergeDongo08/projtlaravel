
@extends('layouts.app')
<!DOCTYPE html>
<html>
    <link rel="icon" href="{{ asset('images/ic.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
<head>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

html,
body {
  -moz-box-sizing: border-box;
       box-sizing: border-box;
  height: 100%;
  width: 100%;
  background: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 400;
}

.wrapper {
  display: table;
  height: 100%;
  width: 100%;
}

.container-fostrap {
  display: table-cell;
  padding: 1em;
  text-align: center;
  vertical-align: middle;
}
.fostrap-logo {
  width: 100px;
  margin-bottom:15px
}
h1.heading {
  color: #fff;
  font-size: 1.15em;
  font-weight: 900;
  margin: 0 0 0.5em;
  color: #505050;
}
@media (min-width: 450px) {
  h1.heading {
    font-size: 3.55em;
  }
}
@media (min-width: 760px) {
  h1.heading {
    font-size: 3.05em;
  }
}
@media (min-width: 900px) {
  h1.heading {
    font-size: 3.25em;
    margin: 0 0 0.3em;
  }
}
.card {
  display: block;
    margin-bottom: 20px;
    line-height: 1.42857143;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
    transition: box-shadow .25s;
}
.card:hover {
  box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
.img-card {
  width: 100%;
  height:200px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
    overflow: hidden;
}
.img-card img{
  width: 100%;
  height: 200px;
  object-fit:cover;
  transition: all .25s ease;
}
.card-content {
  padding:15px;
  text-align:left;
}
.card-title {
  margin-top:0px;
  font-weight: 700;
  font-size: 1.65em;
}
.card-title a {
  color: #000;
  text-decoration: none !important;
}
.card-read-more {
  border-top: 1px solid #D4D4D4;
}
.card-read-more a {
  text-decoration: none !important;
  padding:10px;
  font-weight:600;
  text-transform: uppercase
}
</style>
</head>
<body>
@section('content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div>
                <h1 class="heading">NEWS</h1>
                <div class="float-end">
                    <form class="d-flex" method="GET">
                    <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ request()->query('search') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row">
                     @forelse ($news as $new)
                        <div class="col-xs-12 col-sm-4">
                            <div class="card">
                                <a class="img-card" href="#">
                                <img src="../pictures_news/{{ $new->image_news }}" />
                              </a>
                                <div class="card-content">
                                    <h4 class="card-title">{{ $new->name_news }}</h4>
                                    <p class="">
                                         {{ substr( $new->news ,0, 100)}} ...
                                    </p>
                                </div>
                                <div class="card-read-more">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ str_replace(' ', '',$new->name_news.$new->id) }}"><i class="fas fa-info-circle"></i>Read More</button>
                                </div>
                            </div>
                        </div>
                        @empty
                                <p class="text-center">
                                    No result found for query <strong>{{ request()->query('search') }}</strong>
                                </p>
                                <a href="{{ url('home') }}">Home</a>
                    @endforelse
                    </div>
                </div>
            </div>
            <div style="margin-left: 45%">
                {{ $news->appends(['search' => request()->query('search')])->links() }}
            </div>
        </div>
    </section>

    @foreach ($news as $new)

    <!-- Modal -->
<div class="modal fade" id="{{ str_replace(' ', '',$new->name_news.$new->id) }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $new->name_news }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img class="modal-content" height="250" width="250" src="../pictures_news/{{ $new->image_news }}" />
            ...
          News N°{{ $new->id }} was created on {{ date('d-m-Y', strtotime($new->created_at ))}}
          <br>
          {{ $new->news }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    @endforeach
</div>


@endsection


</body>
</html>


