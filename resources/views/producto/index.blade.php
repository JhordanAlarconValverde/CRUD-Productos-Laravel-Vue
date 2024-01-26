<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Vue js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" referrerpolicy="no-referrer"></script>
    <!-- Fot awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aplicación</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categoria') }}">Categoría</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('producto') }}">Producto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="app" class="container">
        <div class="card mx-auto m-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Producto</h5>

                <form action="" id="formProducto" autocomplete="off">
                    <input type="hidden" class="form-control m-2" placeholder="ID" name="id_producto">
                    <input type="text" class="form-control m-2" placeholder="Nombre" name="nombre">
                    <input type="number" class="form-control m-2" placeholder="Precio" name="precio">
                    <input type="number" class="form-control m-2" placeholder="Stock" name="stock">
                    <button class="btn btn-primary m-2 btnAgregar" @click="agregar">Agregar</button>
                    <button class="btn btn-success m-2 btnActualizar" @click="actualizar">Actualizar</button>
                </form>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="fw-bold text-danger">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="producto in productos">
                    <td score="row" class="fw-bold text-danger">@{{ producto.id_producto }}</td>
                    <td>@{{ producto.nombre }}</td>
                    <td>@{{ producto.descripcion }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning btn-sm btnEditar" @click="editar(producto)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" @click="eliminar(producto.id_producto)"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        const urlStore = `{{ route('producto.store') }}`;
        const urlUpdate = `{{ route('producto.update') }}`;
        const urlDelete = `{{ route('producto.delete', [ 'id' => ':id']) }}`;
        const urlTable = `{{ route('producto.table') }}`;
        window.CSRF_TOKEN = '{{ csrf_token() }}';

        new Vue({
            el: '#app',
            data: {
                productos: [],
                nuevoproducto: {
                    name: '',
                    price: ''
                }
            },
            created() {
                this.listar();
            },
            methods: {
                listar() {
                    var self = this;

                    $('.btnAgregar').attr('disabled', false);
                    $('.btnActualizar').attr('disabled', true);
                    $('#formCategoria').trigger('reset');

                    $.ajax({
                        url: urlTable,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': window.CSRF_TOKEN
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            self.categorias = response;
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            alert('error');
                        }
                    });
                },
                agregar(e) {
                    e.preventDefault();

                    var form = $('#formProducto')[0];
                    var formData = new FormData(form);
                    var self = this;

                    $.ajax({
                        url: urlStore,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': window.CSRF_TOKEN
                        },
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // self.listar();
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            alert('error');
                        }
                    });
                },
                editar(categoria) {
                    $('[name=id_categoria]').val(categoria.id_categoria);
                    $('[name=nombre]').val(categoria.nombre);
                    $('[name=descripcion]').val(categoria.descripcion);
                    $('.btnAgregar').attr('disabled', true);
                    $('.btnActualizar').attr('disabled', false);
                },
                actualizar(e) {
                    e.preventDefault();

                    var form = $('#formCategoria')[0];
                    var formData = new FormData(form);
                    var self = this;

                    $.ajax({
                        url: urlUpdate,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': window.CSRF_TOKEN
                        },
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            self.listar();
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            alert('error');
                        }
                    });
                },
                eliminar(id_categoria) {
                    var direct = urlDelete;
                    var self = this;
                    $.ajax({
                        url: direct.replace(':id', id_categoria),
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': window.CSRF_TOKEN
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            self.listar();
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            alert('error');
                        }
                    });
                }
            }
        });
    </script>
</body>

</html>