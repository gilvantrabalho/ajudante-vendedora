<template>
    <div>
        <div class="container mt-4 shadow-sm bg-white">
            <breadcrumb :items="items" />
        </div>

        <CardContainer v-slot:body>

            <div v-if="loading_grid" class="d-flex justify-content-center p-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <div v-else>
                <table class="table">
                    <thead class="table-light">
                        <tr class="text-secondary">
                            <th>#</th>
                            <th>NOME</th>
                            <!-- <th>NOME DA LISTA</th> -->
                            <th class="text-center">STATUS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in lists">
                            <td class="align-middle">{{ index }}</td>
                            <td class="align-middle">{{ item.user.name }}</td>
                            <!-- <td>{{ item.name }}</td> -->
                            <td class="text-center align-middle">
                                <small class="badge rounded-pill bg-success">RECEBIDA</small>
                            </td>
                            <td class="text-center">
                                <NuxtLink :to="`/admin/lista/${item.id}`" class="btn btn-smb  btn-light shadow-sm">
                                    <i class="bi bi-eye-fill"></i>
                                </NuxtLink>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </CardContainer>
    </div>
</template>

<style>
thead tr th {
    font-weight: 600 !important;
}
</style>

<script>
import CardContainer from '../../../components/containers/CardContainer.vue';
export default {
    auth: true,
    middleware: "AdminMiddleware",
    layout: "admin",
    components: { CardContainer },
    created() {
        this.getAll()
    },
    data() {
        return {
            lists: [],
            loading_grid: false,
            items: [
                {
                    text: 'Home',
                    href: '/admin/home'
                },
                {
                    text: 'Produtos',
                    active: true
                },
                {
                    text: 'Produtos em falta',
                    active: true
                }
            ]
        }
    },
    methods: {        
        getAll: function () {
            this.loading_grid = true;
            this.$axios.get('list-prod/get-all')
                .then(res => {
                    this.lists = res.data.lists;
                })
                .catch(error => console.log(error))
                .then(() => {
                    this.loading_grid = false;
                })
        }
    }
}
</script>