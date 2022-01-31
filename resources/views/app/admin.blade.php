<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    @section('link')
        <link rel="stylesheet" href="/css/tabs.css">
        <link rel="stylesheet" href="/css/tube.css">
        <script src="{{ 'js/tube.js' }}" defer></script>
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div id="app"
                 class="mt-10 center-screen-with-bar d-flex flex-column justify-content-center align-items-center text-center">
                <button ref="open_modal" class="hidden" data-toggle="modal" data-target="#meuModal"></button>
                <!-- Modal -->
                <div id="meuModal" class="modal fade items-center justify-center" role="dialog">
                    <div class="modal-dialog">

                        <!-- Conteúdo do modal-->
                        <div class="modal-content">

                            <!-- Corpo do modal -->
                            <div class="modal-body text-center">
                                <table>
                                    <tr>
                                        <td><b>Paciente:</b></td>
                                        <td>@{{ selectedExam.user.name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Idade:</b></td>
                                        <td>@{{ selectedExam.user.age }} anos</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Rodapé do modal-->
                            <div class="modal-footer justify-center">
                                <button type="button" class="d-btn-less-padding d-btn d-btn-primary d-btn-sm"
                                        v-show="!posting"
                                        @click="setExamType(0)">Não
                                    Reagente
                                </button>
                                <button type="button" class="d-btn-less-padding d-btn d-btn-primary d-btn-sm"
                                        v-show="!posting"
                                        @click="setExamType(1)">
                                    COVID-19
                                </button>
                                <button type="button" class="d-btn-less-padding d-btn d-btn-primary d-btn-sm"
                                        v-show="!posting"
                                        @click="setExamType(2)">
                                    DELTA
                                </button>
                                <button type="button" class="d-btn-less-padding btn-secondary hidden"
                                        data-dismiss="modal"
                                        ref="close_modal">Close
                                </button>
                                <button @click="posting = !posting" class="absolute" style="margin-top: -250px">
                                    asdsad
                                </button>

                                <div class="post-loading d-flex items-center flex-col" v-if="posting">
                                    <p>Aguarde enquanto notificamos o usuário </p>
                                    <div class="mt-2">
                                        <!-- Google Chrome -->
                                        <div class="infinityChrome">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>

                                        <!-- Safari and others -->
                                        <div class="infinity">
                                            <div>
                                                <span></span>
                                            </div>
                                            <div>
                                                <span></span>
                                            </div>
                                            <div>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="test-tube" v-show="loading">

                        <div class="line-top">
                            <span class="line-top__line1"></span>
                            <span class="line-top__line2"></span>
                        </div>

                        <div class="top"></div>

                        <div class="liquid">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="#407DFEFF" fill-opacity="1"
                                      d="M0,192L80,208C160,224,320,256,480,234.7C640,213,800,139,960,117.3C1120,96,1280,128,1360,144L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
                            </svg>
                            <div class="liquid__bottom"></div>
                        </div>

                        <div class="tube"></div>

                        <p class="mt-3">Carregando exames...</p>
                    </div>
                    <div v-show="!loading"><!-- Nav pills -->
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">

                                <a class="nav-link active" data-toggle="pill" href="#marked">Exames Marcados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#waiting">Aguardando Resultado</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#finalized">Finalizados</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="marked" class="container tab-pane active">
                                <ul class="header" v-if="marked.length > 0">
                                    <li>
                                        <span>Nome</span>
                                        <span>Data marcada</span>
                                    </li>
                                </ul>
                                <ul class="list" v-if="marked.length > 0">
                                    <li v-for="i in marked" :key="i.id">
                                        <span>@{{ i.user.name }}</span>
                                        <span>@{{ i.date_formatted }}</span>
                                        <img src="<?php echo e(URL::asset('/images/icon-1.png')); ?>"
                                             @click="doExam(i.id)">
                                    </li>
                                </ul>
                                <p v-else class="mt-4">Não há testes marcados</p>
                            </div>
                            <div id="waiting" class="container tab-pane">
                                <ul class="header" v-if="waiting.length > 0">
                                    <li>
                                        <span>Nome</span>
                                        <span>Resultado</span>
                                    </li>
                                </ul>
                                <ul class="list" v-if="waiting.length > 0">
                                    <li v-for="i in waiting" :key="i.id">
                                        <span>@{{ i.user.name }}</span>
                                        <img src="<?php echo e(URL::asset('/images/icon-2.png')); ?>"
                                             @click="selectExam(i)">
                                    </li>
                                </ul>
                                <p v-else class="mt-4">Não há testes aguardando resultado</p>
                            </div>

                            <div id="finalized" class="container tab-pane ">
                                <ul class="header" v-if="finalized.length > 0">
                                    <li>
                                        <span>Nome</span>
                                        <span>Resultado</span>
                                    </li>
                                </ul>
                                <ul class="list" v-if="finalized.length > 0">
                                    <li v-for="i in finalized" :key="i.id">
                                        <span>@{{ i.user.name }}</span>
                                        <span>@{{ getResultName(i.type)}}</span>
                                    </li>
                                </ul>
                                <p v-else class="mt-4">Não há testes finalizados</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>

        new Vue({
            el: '#app',
            data: {
                selectedExam: {user: {name: ''}},
                loading: true,
                posting: false,
                message: 'Hello World',
                marked: [],
                waiting: [],
                finalized: []
            },

            methods: {

                teste() {
                    document.querySelector('#close-modal').click()
                },
                getResultName(i) {
                    return i == 0 ? 'Não Reagente' : i == 1 ? 'COVID-19' : 'DELTA'
                },


                setExamType(type) {

                    var id = this.selectedExam.id
                    this.posting = true
                    $.ajax({
                        'processing': true,
                        'serverSide': false,
                        type: "POST",
                        dataType: "json",
                        context: this,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {id, type},
                        url: "/set_exam_type",
                        success: function (res) {
                            var idd = this.waiting.findIndex(i => i.id === id);
                            this.waiting.splice(idd, 1)
                            this.finalized.push(res)
                            this.$refs.close_modal.click()
                            this.posting = false
                        }
                    })
                },

                selectExam(exam) {
                    this.selectedExam = exam
                    this.$refs.open_modal.click()
                }
                ,

                doExam(id) {
                    console.log(id)
                    $.ajax({
                        'processing': true,
                        'serverSide': false,
                        type: "POST",
                        dataType: "json",
                        context: this,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {id},
                        url: "/do_exam",
                        success: function (res) {
                            var idd = this.marked.findIndex(i => i.id === id);
                            this.marked.splice(idd, 1)
                            this.waiting.push(res)
                        }
                    })
                }
                ,

                fetchExams() {
                    console.log("asd")
                    var self = this
                    self.loading = true
                    $.ajax({
                        'processing': true,
                        'serverSide': false,
                        type: "GET",
                        dataType: "json",
                        data: {date: $("#date").val()},
                        url: "/exams",
                        success: function (res) {

                            console.log(res)


                            self.marked = res.marked
                            self.waiting = res.waiting
                            self.finalized = res.finalized
                            setTimeout(()=>{
                                self.loading = false
                            }, 5000)

                        }
                    })
                }
            },

            mounted() {
                this.fetchExams()
            }
        })

        var modal = $('#meuModal')

        modal.on('show.bs.modal', (event) => {
            modal.addClass('d-flex');
        })

        modal.on('hide.bs.modal', (event) => {
            modal.removeClass('d-flex');
        })

    </script>

    <style>


        .infinity {
            width: 120px;
            height: 60px;
            position: relative;
        }

        .infinity div,
        .infinity span {
            position: absolute;
        }

        .infinity div {
            top: 0;
            left: 50%;
            width: 60px;
            height: 60px;
            -webkit-animation: rotate 6.9s linear infinite;
            animation: rotate 6.9s linear infinite;
        }

        .infinity div span {
            left: -8px;
            top: 50%;
            margin: -8px 0 0 0;
            width: 16px;
            height: 16px;
            display: block;
            background: #8C6FF0;
            box-shadow: 2px 2px 8px rgba(140, 111, 240, 0.09);
            border-radius: 50%;
            transform: rotate(90deg);
            -webkit-animation: move 6.9s linear infinite;
            animation: move 6.9s linear infinite;
        }

        .infinity div span:before, .infinity div span:after {
            content: "";
            position: absolute;
            display: block;
            border-radius: 50%;
            width: 14px;
            height: 14px;
            background: inherit;
            top: 50%;
            left: 50%;
            margin: -7px 0 0 -7px;
            box-shadow: inherit;
        }

        .infinity div span:before {
            -webkit-animation: drop1 0.8s linear infinite;
            animation: drop1 0.8s linear infinite;
        }

        .infinity div span:after {
            -webkit-animation: drop2 0.8s linear infinite 0.4s;
            animation: drop2 0.8s linear infinite 0.4s;
        }

        .infinity div:nth-child(2) {
            -webkit-animation-delay: -2.3s;
            animation-delay: -2.3s;
        }

        .infinity div:nth-child(2) span {
            -webkit-animation-delay: -2.3s;
            animation-delay: -2.3s;
        }

        .infinity div:nth-child(3) {
            -webkit-animation-delay: -4.6s;
            animation-delay: -4.6s;
        }

        .infinity div:nth-child(3) span {
            -webkit-animation-delay: -4.6s;
            animation-delay: -4.6s;
        }

        .infinityChrome {
            width: 128px;
            height: 60px;
        }

        .infinityChrome div {
            position: absolute;
            width: 16px;
            height: 16px;
            background: #8C6FF0;
            box-shadow: 2px 2px 8px rgba(140, 111, 240, 0.09);
            border-radius: 50%;
            -webkit-animation: moveSvg 6.9s linear infinite;
            animation: moveSvg 6.9s linear infinite;
            filter: url(#goo);
            transform: scaleX(-1);
            offset-path: path("M64.3636364,29.4064278 C77.8909091,43.5203348 84.4363636,56 98.5454545,56 C112.654545,56 124,44.4117395 124,30.0006975 C124,15.5896556 112.654545,3.85282763 98.5454545,4.00139508 C84.4363636,4.14996252 79.2,14.6982509 66.4,29.4064278 C53.4545455,42.4803627 43.5636364,56 29.4545455,56 C15.3454545,56 4,44.4117395 4,30.0006975 C4,15.5896556 15.3454545,4.00139508 29.4545455,4.00139508 C43.5636364,4.00139508 53.1636364,17.8181672 64.3636364,29.4064278 Z");
        }

        .infinityChrome div:before, .infinityChrome div:after {
            content: "";
            position: absolute;
            display: block;
            border-radius: 50%;
            width: 14px;
            height: 14px;
            background: inherit;
            top: 50%;
            left: 50%;
            margin: -7px 0 0 -7px;
            box-shadow: inherit;
        }

        .infinityChrome div:before {
            -webkit-animation: drop1 0.8s linear infinite;
            animation: drop1 0.8s linear infinite;
        }

        .infinityChrome div:after {
            -webkit-animation: drop2 0.8s linear infinite 0.4s;
            animation: drop2 0.8s linear infinite 0.4s;
        }

        .infinityChrome div:nth-child(2) {
            -webkit-animation-delay: -2.3s;
            animation-delay: -2.3s;
        }

        .infinityChrome div:nth-child(3) {
            -webkit-animation-delay: -4.6s;
            animation-delay: -4.6s;
        }

        @-webkit-keyframes moveSvg {
            0% {
                offset-distance: 0%;
            }
            25% {
                background: #5628EE;
            }
            75% {
                background: #23C4F8;
            }
            100% {
                offset-distance: 100%;
            }
        }

        @keyframes moveSvg {
            0% {
                offset-distance: 0%;
            }
            25% {
                background: #5628EE;
            }
            75% {
                background: #23C4F8;
            }
            100% {
                offset-distance: 100%;
            }
        }

        @-webkit-keyframes rotate {
            50% {
                transform: rotate(360deg);
                margin-left: 0;
            }
            50.0001%, 100% {
                margin-left: -60px;
            }
        }

        @keyframes rotate {
            50% {
                transform: rotate(360deg);
                margin-left: 0;
            }
            50.0001%, 100% {
                margin-left: -60px;
            }
        }

        @-webkit-keyframes move {
            0%, 50% {
                left: -8px;
            }
            25% {
                background: #5628EE;
            }
            75% {
                background: #23C4F8;
            }
            50.0001%, 100% {
                left: auto;
                right: -8px;
            }
        }

        @keyframes move {
            0%, 50% {
                left: -8px;
            }
            25% {
                background: #5628EE;
            }
            75% {
                background: #23C4F8;
            }
            50.0001%, 100% {
                left: auto;
                right: -8px;
            }
        }

        @-webkit-keyframes drop1 {
            100% {
                transform: translate(32px, 8px) scale(0);
            }
        }

        @keyframes drop1 {
            100% {
                transform: translate(32px, 8px) scale(0);
            }
        }

        @-webkit-keyframes drop2 {
            0% {
                transform: translate(0, 0) scale(0.9);
            }
            100% {
                transform: translate(32px, -8px) scale(0);
            }
        }

        @keyframes drop2 {
            0% {
                transform: translate(0, 0) scale(0.9);
            }
            100% {
                transform: translate(32px, -8px) scale(0);
            }
        }

        .infinity {
            display: none;
        }

        html {
            -webkit-font-smoothing: antialiased;
        }

        * {
            box-sizing: border-box;
        }

        *:before, *:after {
            box-sizing: border-box;
        }

        .modal-content {
            height: 200px;
        }

        .modal-dialog {
            min-width: 565px;
        }

        .modal-dialog table {
            font-size: 1.3em;
        }

        .modal-dialog table tr td {
            text-align: left;
        }

        .modal-dialog table tr td:first-child {
            padding-right: 18px;
        }

        .d-btn-less-padding {
            padding: 7px 35px;
        }

        .post-loading {
            margin-top: -18px;
        }
    </style>
    <script>
        // Because only Chrome supports offset-path, feGaussianBlur for now

        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

        if (!isChrome) {
            document.getElementsByClassName('infinityChrome')[0].style.display = "none";
            document.getElementsByClassName('infinity')[0].style.display = "block";
        }
    </script>
</x-app-layout>
