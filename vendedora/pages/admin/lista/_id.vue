<template>

    <div>
        <div class="container mt-4 shadow-sm bg-white">
            <breadcrumb :items="items" />
        </div>

        <div class="container">

            <div class="row">

                <div class="col-md-4 ps-0">
                    <Card v-slot:body>
                        <h6>Enviada por:</h6>
                        <span>
                            {{ list ? list.user.name : null }}
                        </span>
                    </Card>
                </div>

                <div class="col-md-8 pe-0">
                    <Card v-slot:body>
                        <div class="d-flex justify-content-between">
                            <h6>Lista:</h6>
                            <div v-if="list ? list.name : null">
                                <small v-if="list.status == 'ENVIADA'"
                                    class="badge rounded-pill bg-success">RECEBIDA</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {{ list ? list.name : null }}
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>

                    </Card>
                </div>

                <div class="col-md-12 px-0">
                    <Card v-slot:body>

                        <div v-if="loading_grid" class="d-flex justify-content-center p-5">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div v-else>
                            <div class="text-end mb-2">
                                <button class="btn btn-primary" @click="generateReport">
                                    <i class="bi bi-filetype-pdf"></i> Gerar PDF</button>
                                <button @click="concluirLista(list ? list.user_id : null, list ? list.name : null)"
                                    type="button" class="btn btn-success shadow-sm">
                                    <i class="bi bi-check-circle"></i>
                                    Concluir lista</button>
                            </div>

                            <table class="table">
                                <thead class="table-light">
                                    <tr class="text-secondary">
                                        <th>#</th>
                                        <th>NOME PRODUTO</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">MUDAR STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in list ? list.products_for_list : []">
                                        <td class="align-middle">{{ index }}</td>
                                        <td class="align-middle">{{ item.name }}</td>
                                        <td class="text-center align-middle">
                                            <status-product-for-list :status="item.status" />
                                        </td>
                                        <td class="text-center d-flex justify-content-center">
                                            {{ set_status }}
                                            <select :value="item.status" @change="setStatus(item.name, item.id, $event)"
                                                class="form-control w-50">
                                                <option class="text-center" value="NÃO TEM">NÃO TEM</option>
                                                <option class="text-center" value="ACABOU">ACABOU</option>
                                                <option class="text-center" value="URGENTE">URGENTE</option>
                                                <option class="text-center" value="CONCLUÍDA">CONCLUÍDA</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <vue-html2pdf :show-layout="false" :float-layout="true" :enable-download="true"
                                :preview-modal="true" :paginate-elements-by-height="1400"
                                :filename="list ? list.name : null" :pdf-quality="2" :manual-pagination="false"
                                pdf-format="a4" pdf-orientation="landscape" pdf-content-width="800px"
                                @progress="onProgress($event)" @hasStartedGeneration="hasStartedGeneration()"
                                @hasGenerated="hasGenerated($event)" ref="html2Pdf">
                                <section slot="pdf-content">

                                    <table class="table">
                                        <thead class="table-light">
                                            <tr class="text-secondary">
                                                <th>#</th>
                                                <th>NOME PRODUTO</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">MUDAR STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in list ? list.products_for_list : []">
                                                <td class="align-middle">{{ index }}</td>
                                                <td class="align-middle">{{ item.name }}</td>
                                                <td class="text-center align-middle">
                                                    <status-product-for-list :status="item.status" />
                                                </td>
                                                <td class="text-center d-flex justify-content-center">
                                                    {{ set_status }}
                                                    <select :value="item.status"
                                                        @change="setStatus(item.name, item.id, $event)"
                                                        class="form-control w-50">
                                                        <option class="text-center" value="NÃO TEM">NÃO TEM</option>
                                                        <option class="text-center" value="ACABOU">ACABOU</option>
                                                        <option class="text-center" value="URGENTE">URGENTE</option>
                                                        <option class="text-center" value="CONCLUÍDA">CONCLUÍDA</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </section>
                            </vue-html2pdf>


                        </div>

                    </Card>
                </div>

            </div>

        </div>
    </div>

</template>

<script>
import CardContainer from '../../../components/containers/CardContainer.vue';
import Card from '../../../components/containers/Card.vue';

import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

export default {
    auth: true,
    middleware: "AdminMiddleware",
    layout: "admin",
    data() {
        return {
            loading_grid: false,
            set_status: null,
            list: null,
            items: [
                {
                    text: 'Home',
                    href: '/admin/home'
                },
                {
                    text: 'Produtos em falta',
                    href: '/admin/produtos/produtos-falta'
                },
                {
                    text: 'Lista',
                    active: true
                }
            ]
        };
    },
    components: { CardContainer, Card },
    created() {
        this.getProducts();
    },
    methods: {
        onProgress(event) {
            console.log(event)
        },
        generateReport() {
            this.$refs.html2Pdf.generatePdf()
        },
        getProducts: function () {
            this.$axios.get(`list-prod/get-by-id/${this.$route.params.id}`)
                .then(res => {
                    this.list = res.data.list
                    console.log(res.data.list)
                })
                .catch(error => console.log(error))
                .then(() => { })
        },
        setStatus: function (name, id, event) {
            this.loading_grid = true;
            this.$axios.put(`notify/update/${id}`, {
                name: name,
                status: event.target.value
            })
                .then(res => {
                    if (!res.data.error) {
                        this.getProducts();
                    } else {
                        this.$notify.error({
                            title: 'Error',
                            message: 'Erro ao tentar editar. Tente novamente!'
                        });
                    }
                })
                .catch(error => {

                })
                .then(() => {
                    this.loading_grid = false;
                })


        },
        concluirLista: function (user_id, list_name) {
            Vue.swal({
                title: 'Deseja mesmo concluir a lista?',
                text: list_name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, concluir!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loading_grid = true;
                    this.$axios.put(`list-prod/update/${this.$route.params.id}`, {
                        user_id: user_id,
                        name: list_name,
                        status: 'CONCLUÍDA'
                    })
                        .then(res => {
                            if (!res.data.error) {
                                this.$notify.success({
                                    title: 'Sucesso!',
                                    message: 'Lista concluída com sucesso!'
                                });
                                setTimeout(() => {
                                    this.$router.push('/admin/produtos/produtos-falta')
                                }, 1800)

                            } else {
                                this.$notify.warning({
                                    title: 'Ops',
                                    message: res.data.response.message
                                });
                            }
                        })
                        .catch()
                        .then(() => this.loading_grid = false)
                }
            })
        }
    }
}
</script>