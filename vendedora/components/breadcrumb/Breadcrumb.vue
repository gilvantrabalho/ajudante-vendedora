<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded">
            <li v-for="item in items" :class="`breadcrumb-item ${item.active ? 'active' : ''}`">
                <a :href="item.href">{{ item.text }}</a>
            </li>
        </ol>
    </nav>
</template>

<style>
.breadcrumb
{
    padding: 12px;
}
.breadcrumb li a {
    font-size: 14px !important;
    text-decoration: none !important;
}
</style>

<script>
export default {
    name: 'breadcrumb',
    props: ['items']
}
</script>