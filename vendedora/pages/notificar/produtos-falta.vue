<template>
    <div class="container mt-4">

        <div class="row">

            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-0 shadow-sm rounded">
                        <h5 class="m-0 p-0 py-2 text-secondary">Produto</h5>
                    </div>
                    <div class="card-body py-4">

                        <div v-if="loadingForm" class="d-flex justify-content-center p-5">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div v-else>
                            <form @submit.prevent="submit" class="form-lista" action="">
                                <div class="input-list">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <h4 class="p-0 m-0">
                                                <i class="bi bi-card-checklist text-secondary"></i>
                                            </h4>
                                        </span>
                                        <input @keyup="search" v-model="name" type="text" class="form-control p-3"
                                            placeholder="Nome do produto..." aria-describedby="basic-addon1">
                                    </div>

                                    <ul v-if="show_list" class="shadow p-0">
                                        <li v-for="item in prods_array" @click="getValorLista(item)"
                                            class="p-3 border-bottom">
                                            {{ item.name }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">Status: </label>
                                    <select v-model="status" class="form-control p-3" name="" id="">
                                        <option class="p-3" value="">Selecione...</option>
                                        <option class="p-3" value="NÃO TEM">NÃO TEM</option>
                                        <option class="p-3" value="ACABOU">ACABOU</option>
                                        <option class="p-3" value="URGENTE">URGENTE</option>
                                    </select>
                                </div>

                                <div v-if="!prod_editar">
                                    <div class="d-flex mt-3">
                                        <button class="btn btn-success w-50 me-2 p-3" type="submit">SALVAR</button>
                                        <button @click="cancelarEditar" class="btn btn-outline-danger w-50"
                                            type="button">CANCELAR</button>
                                    </div>
                                </div>

                                <div v-else>
                                    <div class="d-flex mt-3">
                                        <button @click="editar" class="btn btn-primary w-50 me-2 p-3"
                                            type="button">EDITAR</button>
                                        <button @click="cancelarEditar" class="btn btn-outline-danger w-50"
                                            type="button">CANCELAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 cont-col-lista">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-0 d-flex justify-content-between shadow-sm rounded">
                        <h5 class="m-0 p-0 py-2 text-secondary">Lista</h5>
                        <div class="d-flex align-items-center">
                            <div class="fst-italic my-2">{{ lista ? lista.name : '' }}</div>
                            <div class="ms-2 d-flex">
                                <button v-if="lista" @click="deletarLista" class="btn btn-sm btn-danger d-block ms-1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div v-if="loadingProds" class="d-flex justify-content-center p-5">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div v-else>
                            <div v-if="produtos.length == 0">
                                <h5 class="text-center p-3 mt-2">Nenhum produto cadastrado!</h5>
                            </div>
                            <div v-for="(item, index) in produtos" class="border-bottom border-secondary">
                                <div class="cont-lista pe-1">

                                    <div class="d-flex align-items-center">
                                        <div class="btn-group dropend">
                                            <i class="btn-op bi bi-three-dots-vertical bg-dark py-3 px-1"
                                                data-bs-toggle="dropdown" aria-expanded="false"></i>
                                            <ul class="dropdown-menu">
                                                <li><a @click="getProdutoEditar(item.id)" class="dropdown-item"
                                                        href="#">Editar</a></li>
                                                <li><a @click="deletar(item.id, index, item.name)" class="dropdown-item"
                                                        href="#">Deletar</a></li>
                                            </ul>
                                        </div>

                                        <div class="text-break ms-1">
                                            {{ item.name }}
                                        </div>
                                    </div>

                                    <status-product-for-list :status="item.status" />

                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button v-if="lista" @click="enviarLista" type="button"
                                class="btn btn-success mt-3 p-3">ENVIAR
                                LISTA</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<style>
.cont-btns {}

.btn-op {
    cursor: pointer;
}

.form-lista label {
    font-weight: 500 !important;
    font-size: 14px;
}

.cont-lista {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center;
    font-family: Comic Sans Ms;
    font-size: 18px;
    transition: 0.5s;
    width: 100% !important;
}

.cont-lista:hover {
    background-color: #1C1C1C !important;
}

@media only screen and (max-width: 770px) {
    .cont-col-lista {
        margin-top: 20px !important;
    }
}

.badge-sm {
    font-size: 12px;
}

.input-list ul {
    position: absolute;
    margin-top: -15px !important;
    list-style: none;
    width: 100% !important;
    font-weight: 500;
    background-color: white;
    z-index: 999;
}

.input-list ul li {
    cursor: pointer;
}

.card {
    background-color: #242526 !important;
}

.card-header div {
    color: #CFCFCF;
}

.card-header {
    background-color: #1C1C1C;
}

.card-body {
    color: #CFCFCF;
}

input,
select {
    background-color: #363636 !important;
    border-color: #363636 !important;
}

.input-group-text {
    background-color: #1C1C1C;
    border-color: #1C1C1C;
}

.form-control {
    color: #9C9C9C !important;
}

select::selection {
    color: lightblue !important;
    background-color: black !important;
}

::-webkit-input-placeholder {
    color: #9C9C9C !important;
}

:-moz-placeholder {
    /* Firefox 18- */
    color: #9C9C9C !important;
}

::-moz-placeholder {
    /* Firefox 19+ */
    color: #9C9C9C !important;
}

:-ms-input-placeholder {
    color: #9C9C9C !important;
}
</style>

<script>
import CardContainer from '../../components/containers/CardContainer.vue'
import Input from '../../components/form/Input.vue';
import ButtonBlock from '../../components/buttons/ButtonBlock.vue';

import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

export default {
    middleware: 'ClientMiddleware',
    layout: 'client',
    components: {
        CardContainer, Input, ButtonBlock
    },
    data() {
        return {
            prod_editar: null,
            loadingProds: true,
            loadingForm: false,
            loading: false,
            name: null,
            status: '',
            lista: null,
            produtos: [],
            prods_array: [],
            show_list: false
        }
    },
    created() {
        this.getProducts();
    },
    methods: {
        getProducts: function () {
            this.loadingProds = true;
            this.$axios.get(`notify/get-all/${this.$auth.user.id}`)
                .then(res => {
                    let lista = res.data.response.list
                    if (lista) {
                        this.lista = lista;
                        this.produtos = lista.products_for_list.reverse();
                    } else {
                        this.lista = null;
                        this.produtos = [];
                    }
                })
                .catch(error => {
                    console.log(error)
                })
                .then(() => {
                    this.loadingProds = false;
                });
        },
        submit: function () {
            if (this.name && this.status) {
                // Cadastrar um produto. Cria um nome de lista com o primeiro produto cadastrado!
                this.loading = true;
                this.loadingProds = true;
                this.$axios.post('notify/register-product', {
                    user_id: this.$auth.user.id,
                    list_prods_id: this.lista ? this.lista.id : null,
                    username: this.$auth.user.name,
                    name: this.name,
                    status: this.status
                })
                    .then(res => {
                        if (!res.data.error) {
                            this.lista = res.data.response.lista;
                            this.produtos.unshift({
                                name: this.name,
                                status: this.status
                            })
                            this.name = '';
                            this.status = '';
                            this.$notify.success({
                                title: 'Sucesso!',
                                message: 'Produto adicionado.'
                            });
                        } else {
                            this.$notify.error({
                                title: 'Error',
                                message: res.data.response.message
                            });
                        }

                    })
                    .catch(error => {

                    })
                    .then(() => {
                        this.loading = false;
                        this.loadingProds = false;
                    })

            }
        },
        deletar: function (id, index, name) {
            Vue.swal({
                title: 'Deseja mesmo deletar?',
                text: name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.delete(`notify/delete/${id}`);
                    this.getProducts();
                    Vue.swal(
                        'Deletado!',
                        'Item deletado com sucesso.',
                        'success'
                    )
                }
            })
        },
        deletarLista: function () {
            if (this.lista) {
                Vue.swal({
                    title: 'Deseja mesmo deletar a Lista?',
                    text: this.lista.name,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$axios.delete(`list-prod/delete/${this.lista.id}`);
                        this.getProducts();
                        Vue.swal(
                            'Deletado!',
                            'Lista deletada com sucesso.',
                            'success'
                        )
                    }
                })
            }
        },
        getProdutoEditar: function (id) {
            this.loadingForm = true;
            this.$axios.get(`notify/show/${id}`)
                .then(res => {
                    if (res.data.product) {
                        this.prod_editar = res.data.product;
                        this.name = res.data.product.name;
                        this.status = res.data.product.status;
                    } else {
                        this.id_editar = null;
                    }
                })
                .catch(error => console.log(error))
                .then(() => this.loadingForm = false);
        },
        editar: function (id) {
            this.loadingForm = true;
            this.$axios.put(`notify/update/${this.prod_editar.id}`, {
                name: this.name,
                status: this.status
            })
                .then(res => {
                    if (!res.data.error) {
                        this.getProducts();
                        this.prod_editar = null;
                        this.name = '';
                        this.status = '';
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
                    this.loadingForm = false;
                })

        },
        cancelarEditar: function () {
            this.prod_editar = null;
            this.name = '';
            this.status = '';
        },
        enviarLista: function () {
            if (this.lista) {

                Vue.swal({
                    title: 'Enviar lista?',
                    text: this.lista.name,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, enviar!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.loadingProds = true;
                        this.$axios.get(`list-prod/enviar/${this.lista.id}`)
                            .then(res => {
                                if (!res.data.error) {
                                    this.getProducts();
                                    this.$notify.success({
                                        title: 'Sucesso!',
                                        message: 'Sua lista foi enviada com sucesso.'
                                    });
                                } else {
                                    this.$notify.error({
                                        title: 'Error!',
                                        message: 'Erro ao tentar enviar. Tente novamente!'
                                    })
                                }
                            })
                            .catch(error => {

                            })
                            .then(() => {
                                this.loadingProds = true;
                            })
                    }
                })
            }
        },
        getValorLista: function (item) {
            this.name = item.name;
            this.show_list = false;
            this.prods_array = [];
        },
        search: function () {
            if (this.name.length > 2) {
                this.$axios.get(`product/get-by-name/${this.name ? this.name : null}`)
                    .then(res => {
                        if (res.data.product.length > 0) {
                            this.prods_array = res.data.product;
                            this.show_list = true;
                        }
                    })
            } else {
                this.prods_array = [];
            }
        }
    }
}
</script>