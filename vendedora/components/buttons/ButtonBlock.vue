<template>
    <div class="d-grid gap-2">
        <button v-if="!loading" :class="`btn-block btn btn-${color}`" :type="type">
            {{ title }}
        </button>

        <button v-else :class="`btn btn-${color} mt-3`" :type="type">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </button>
    </div>
</template>

<style>
.btn-block {
    padding: 15px !important;
}
</style>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'Botão'
        },
        type: {
            type: String,
            default: 'type'
        },
        loading: {
            type: Boolean,
            default: false
        },
        color: {
            type: String,
            default: 'primary'
        }
    }
}
</script>