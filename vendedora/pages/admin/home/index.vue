<template>
    <CardContainer v-slot:body>
        ADMIN {{ $auth.loggedIn }}
    </CardContainer>
</template>

<script>
import CardContainer from '../../../components/containers/CardContainer.vue';
export default {
    auth: true,
    middleware: "AdminMiddleware",
    layout: "admin",
    components: { CardContainer }
}
</script>