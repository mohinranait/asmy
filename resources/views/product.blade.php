<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button class="navbar-toggler px-0" type="button" data-mdb-toggle="collapse"
      data-mdb-target="#navbarExample1" aria-controls="navbarExample1" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarExample1">
      <!-- Left links -->
      <ul class="navbar-nav me-auto ps-lg-0" style="padding-left: 0.15rem">
        <li class="nav-item">
          <a class="nav-link" href="#">Regular link</a>
        </li>
        <!-- Navbar dropdown -->
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-mdb-toggle="dropdown" aria-expanded="false">
            Mega menu
          </a>
          <!-- Dropdown menu -->
          <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="
                          border-top-left-radius: 0;
                          border-top-right-radius: 0;
                        ">
            <div class="container">
              <div class="row my-4">
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="list-group list-group-flush">
                    <a href="" class="list-group-item list-group-item-action">Lorem ipsum</a>
                    <a href="" class="list-group-item list-group-item-action">Dolor sit</a>
                    <a href="" class="list-group-item list-group-item-action">Amet consectetur</a>
                    <a href="" class="list-group-item list-group-item-action">Cras justo odio</a>
                    <a href="" class="list-group-item list-group-item-action">Adipisicing elit</a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="list-group list-group-flush">
                    <a href="" class="list-group-item list-group-item-action">Explicabo voluptas</a>
                    <a href="" class="list-group-item list-group-item-action">Perspiciatis quo</a>
                    <a href="" class="list-group-item list-group-item-action">Cras justo odio</a>
                    <a href="" class="list-group-item list-group-item-action">Laudantium maiores</a>
                    <a href="" class="list-group-item list-group-item-action">Provident dolor</a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-md-0">
                  <div class="list-group list-group-flush">
                    <a href="" class="list-group-item list-group-item-action">Iste quaerato</a>
                    <a href="" class="list-group-item list-group-item-action">Cras justo odio</a>
                    <a href="" class="list-group-item list-group-item-action">Est iure</a>
                    <a href="" class="list-group-item list-group-item-action">Praesentium</a>
                    <a href="" class="list-group-item list-group-item-action">Laboriosam</a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="list-group list-group-flush">
                    <a href="" class="list-group-item list-group-item-action">Cras justo odio</a>
                    <a href="" class="list-group-item list-group-item-action">Saepe</a>
                    <a href="" class="list-group-item list-group-item-action">Vel alias</a>
                    <a href="" class="list-group-item list-group-item-action">Sunt doloribus</a>
                    <a href="" class="list-group-item list-group-item-action">Cum dolores</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
    

    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="form-group">
                    {{ $product->name }}
                    <select name="" class="form-control" id="">

                        <option value="">Select Tags</option>
                        @foreach( $tags_string as $key)
                        <option value="">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


