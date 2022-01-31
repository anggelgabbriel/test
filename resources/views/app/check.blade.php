<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div
                class="mt-10 center-screen-with-bar d-flex flex-column justify-content-center align-items-center text-center">
                <div class="form-in">
                    <p>Olá <span class="fw-bold underline">{!! $user_name !!}</span>, tudo bem? </p>

                    @if(is_null($exam->type))
                        <p>Infelizmente o resultado do seu exame ainda não foi liberado.
                        <p class="mt-4">Enquanto isso vamos ver alguns índices:</p>
                    @elseif($exam->type == 0)
                        <p>O resultado do seu exame deu <span class="fw-bold underline">Não Reagente</span> para o
                            COVID-19.
                        <p class="mt-4">Agora vamos ver alguns índices:</p>
                    @else
                        <p>O resultado do seu exame foi <span class="fw-bold underline">Reagente</span>
                            para <span class="fw-bold">COVID-19</span>,
                            @if($exam->type == 1)
                                e em relação a variante  <span class="fw-bold">DELTA</span> você teve um resultado
                                <span
                                    class="fw-bold underline">Não Reagente</span>.
                            @else
                                e em relação a variante  <span class="fw-bold">DELTA</span> você teve um resultado  <span
                                        class="fw-bold underline">Reagente</span>.
                    @endif
                    <p/>
                    <p class="mt-4">Agora vamos ver alguns índices:</p>

                    @endif
                    <p>De <span class="fw-bold underline">{!! $all !!}</span> pessoas testadas no nosso laboratório
                        <span
                            class="fw-bold underline">{!! $covid + $delta !!}</span> testaram positivo
                        para <span class="fw-bold">COVID-19</span>, enquanto desse total, <span
                            class="fw-bold underline">{!! $delta !!}</span> testaram positivo para a variante <span
                            class="fw-bold">DELTA</span>.</p>

                    @if(!is_null($exam->type))
                        <p class="mt-2">Compareça ao nosso laboratório para pegar o relatório físico.</p>
                    @endif

                    <button type="button" class="mt-4 btn d-btn d-btn-full d-btn-primary" id="btn-ok">
                        Entendido
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btn-ok').click(() => {
            window.location.href = '/dashboard';
        })
    </script>


</x-app-layout>
