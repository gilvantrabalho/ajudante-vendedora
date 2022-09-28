<template>
    <div class="input-group mb-3">
        <span v-if="icon" class="input-group-text" id="basic-addon1">
            <h4 class="p-0 m-0">
                <i :class="`${icon} text-secondary`"></i>
            </h4>
        </span>
        <input 
            v-model="model" 
            :type="type" 
            class="form-control p-3" 
            :placeholder="placeholder"
            aria-label="Username" 
            aria-describedby="basic-addon1"
        >
    </div>
</template>

<style>
.form-control:focus {
    box-shadow: none !important;
}
</style>

<script>
export default {
    props: {
        type: {
            type: String,
            require: true,
        },
        icon: {
            type: String,
            require: true,
        },
        placeholder: {
            type: String,
            require: true,
        }
    },
    computed: {
        model: {
            get() {
                return this.value;
            },
            set(value) {
                this.$emit('input', value);
            },
        }
    }
}
</script>