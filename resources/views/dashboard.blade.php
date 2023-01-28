<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('content')
    <?php
    use Illuminate\Support\Facades\DB;
    $id = auth()->user()->level;
    $userName = auth()->user()->name;
    if ($id >= 4) {
    ?>

    <script>
        $(document).ready(function() {
            $('#pesquisa').keyup(function () {
                var id = $(this).val();
                if (id != '') {
                    $.ajax({
                        url: "pesquisa/" + id,
                        method: "get",
                        data: {id: id},
                        success: function (data) {
                            $('#display-1').fadeOut();
                            $('#display-2').fadeIn();
                            $('#display-2').html(data);
                        }
                    });
                }   else {
                    $('#display-2').fadeOut();
                    $('#display-1').fadeIn();
                }
            });
        });
    </script>


    <section id="sku-all">
        <div class="container mt-5">
            <div class="d-flex">
                <div class="criar-sku col-8">
                    <form action="/create-sku" method="POST">
                        <input type="hidden" value="<?= $userName ?>" name="create_by">
                        @csrf
                        <label>Nome da SKU</label>
                        <input type="text" name="name">
                        <label>SKU</label>
                        <input type="number" name="id">
                        <button class="text-white btn btn-fill btn-primary">Criar</button>
                    </form>
                </div>
                <div class="col-4">
                    <form>
                        @csrf
                        <input type="text" id="pesquisa" placeholder="Pesquise...">
                    </form>
                </div>
            </div>


            <div id="display-1" class="display-sku">
                    <?php
                    $skus = DB::table('skus')->get();
                foreach ($skus as $sku) {
                    ?>
                <div class="sku-item mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <p>
                                ID:<span class="sku-id ml-2 mr-3"><?= $sku->id ?></span> Nome:  <span class="sku-name mr-3 ml-2"><?= $sku->name ?></span>
                            </p>

                        </div>
                        <div>
                            <a href="{{ url("edit/$sku->id") }}" class="text-white btn btn-fill btn-primary">Editar</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div id="display-2" class="display-sku">

            </div>
        </div>
    </section>

    <?php } else { ?>
    <div style="text-align: center">
        <h1>Acesso negado!</h1>
        <p>Contate o Administrador.</p>
        <br>
        <h1>Access denied!</h1>
        <p>Contact Administrator.</p>
    </div>

    <?php } ?>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
