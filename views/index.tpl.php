<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
        name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon -->
        <link
        rel="shortcut icon" type="image/x-icon" href="assets/favicon.ico">

        <!-- Bootstrap CSS -->
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous"/>
        <title>PHP CRUD</title>
        <style>
            #loader {
                background: rgba(255, 255, 255, 0.7);
                text-align: center;
                position: absolute;
                top: 150px;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 2;
                display: none;
            }

            #loader img {
                width: 100px;
            }
            #clear-search {
                cursor: pointer;
            }
        </style>
    </head>

<body>


<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center h2 my-3">PHP CRUD with AJAX, MySQL and Bootstrap</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary rounded-0 btn-add" data-bs-toggle="modal" data-bs-target="#addCity">Add city
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" id="search" class="form-control" placeholder="Search...">
                        <span class="input-group-text" id="clear-search">&times;</span>
                    </div>
                </div>
            </div>

        </div>

        <div id="loader">
            <img src="assets/ripple.svg" alt="">
        </div>

        <div
            class="table-responsive my-3"><?php require_once 'views/index-content.tpl.php' ?>
        </div>
    </div>
</div>

        <!-- Modal Add city -->
        <div class="modal fade" id="addCity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add city</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="addCityForm">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="addName" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="addName" placeholder="City name">
                                </div>
                                <div class="mb-3">
                                    <label for="addPopulation" class="form-label">Population</label>
                                    <input type="number" name="population" class="form-control" id="addPopulation" placeholder="City population">
                                    <input type="hidden" name="addCity">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="btn-add-submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Add city-->

        <!-- Modal Edit city -->
        <div class="modal fade" id="editCity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit city</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCityForm" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="editName" class="form-label">City name</label>
                                    <input type="text" class="form-control" name="name" id="editName">
                                </div>
                                <div class="mb-3">
                                    <label for="editPopulation" class="form-label">Population</label>
                                    <input type="number" name="population" class="form-control" id="editPopulation" placeholder="City population">
                                    <input type="hidden" name="editCity">
                                    <input type="hidden" name="id" id="id">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary" id="btn-edit-submit">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit city-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"> </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="assets/mark.min.js"></script>
        <script src="assets/main.js"></script>
    </body>

</html>

