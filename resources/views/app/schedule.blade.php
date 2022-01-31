<x-app-layout>
    <!-- Modal -->
    <div id="meuModal" class="modal fade items-center justify-center" role="dialog">
        <div class="modal-dialog">

            <!-- Conteúdo do modal-->
            <div class="modal-content">

                <!-- Cabeçalho do modal -->
            {{--                            <div class="modal-header">--}}
            {{--                                <h4 class="modal-title">Agendamento concluído com sucesso!</h4>--}}
            {{--                                <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
            {{--                            </div>--}}

            <!-- Corpo do modal -->
                <div class="modal-body text-center">
                    <h1 class="font-semibold">Agendamento concluído com sucesso!</h1>
                    <h5 class="mt-2">Se cuide até lá!</h5>
                </div>

                <!-- Rodapé do modal-->
                <div class="modal-footer justify-center">
                    <button type="button" class="btn-sm d-btn d-btn-primary d-btn-sm" id="btn-ok">Ok</button>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div
                class="mt-10 center-screen-with-bar d-flex flex-column justify-content-center align-items-center text-center">
                <div class="form-in">
                    <p class="text-center">Selecione a data do seu agendamento</p>
                    @if ($errors->any())
                        <div class="p-1 mb-2 bg-danger text-white rounded-top rounded-bottom">
                            <ul class="mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ __($error) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form>
                        <div class="form-group" style="color: #0B23AD">
                            <input class="date form-control" id="date" type="text">
                        </div>

                        <button type="button" class="mt-4 btn d-btn d-btn-full d-btn-primary" id="agendar">
                            Agendar
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(() => {

            var modal = $('#meuModal')

            modal.on('show.bs.modal', (event) => {
                modal.addClass('d-flex');
            })

            modal.on('hide.bs.modal', (event) => {
                modal.removeClass('d-flex');
            })

            $('.date').datepicker({
                format: 'dd/mm/yyyy',
                calendarWeeks: false,
                autoclose: true,
                todayHighlight: true,
                orientation: "auto"
            });

            $('#agendar').click(() => {
                $.ajax({
                    'processing': true,
                    'serverSide': false,
                    type: "GET",
                    data: {date: $("#date").val()},
                    url: "/do_schedule",
                    success: function (s) {
                        modal.modal()
                    }
                })
            })

            $('#btn-ok').click(() => {
                window.location.href = '/dashboard';
            })
        })


    </script>
</x-app-layout>
