@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <?php
    use Illuminate\Support\Facades\DB;
    $id = auth()->user()->level;
    $userName = auth()->user()->name;
    if ($id >= 4) {
    ?>

    <section id="sku-all">
        <div class="container mt-5">
            <div class="criar-sku">
                <form action="/create-sku" method="POST">
                    <input type="hidden" value="<?= $userName ?>" name="create_by">
                    @csrf
                    <label>Nome da SKU</label>
                    <input type="text" name="name">
                    <label>SKU</label>
                    <input type="number" name="id">
                    <button>Criar</button>
                </form>
            </div>

            <div class="display-sku">
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
