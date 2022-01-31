<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div
                class="mt-10 center-screen-with-bar d-flex flex-column justify-content-center align-items-center text-center">
                <p class="text">Agora precisamos saber: você tem sintomas semelhantes ao da COVID-19?</p>
                @if(!$exam)
                    <p class="sub-text mt-4">Nesta área você pode agendar o seu teste de COVID, ou conusltar o
                        resultado de um teste já realizado.</p>
                @else
                    <p class="sub-text mt-4">Você já possui um agendamento cadastrado</p>
                @endif


                <div class="bottom mt-4">

                    @if(!$exam)
                        <a href="/schedule" button class="btn d-btn d-btn-primary">Agende seu teste</a>
                    @endif
                    <a href="/check" class="d-btn btn btn-outline-primary">Consultar resultados</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
