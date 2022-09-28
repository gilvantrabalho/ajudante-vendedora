<template>
    <div>
        <small v-if="status == 'ACABOU'" class="d-inline-block badge badge-sm rounded-pill bg-warning shadow-sm">
            {{ status }}
        </small>
        <small v-if="status == 'URGENTE'" class="d-inline-block badge badge-sm rounded-pill bg-danger shadow-sm">
            {{ status }}
        </small>
        <small v-if="status == 'NÃO TEM'" class="d-inline-block badge badge-sm rounded-pill bg-info shadow-sm">
            {{ status }}
        </small>
        <small v-if="status == 'CONCLUÍDA'" class="d-inline-block badge badge-sm rounded-pill bg-success shadow-sm">
            {{ status }}
        </small>
    </div>
</template>

<script>
export default {
    name: 'status-product-for-list',
    props: ['status']
}
</script>