<template>
    <CardContainer v-slot:body>
        Vendedora!
    </CardContainer>
</template>

<script>
import CardContainer from '../../components/containers/CardContainer.vue'

export default {
    middleware: 'ClientMiddleware',
    layout: 'client',
    components: {
        CardContainer
    }
}
</script>