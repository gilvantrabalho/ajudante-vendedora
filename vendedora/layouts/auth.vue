<template>
    <div class="fundo-auth position-absolute w-100 h-100 d-flex justify-content-center align-items-center">
        <div class="media-auth shadow p-5 rounded bg-white">
            <Nuxt />
        </div>
    </div>
</template>

<style>
.fundo-auth
{
    background-color: #F0F8FF;
}

@media only screen and (max-width: 505px) {
  .media-auth {
    padding: 40px !important;
  }
}
</style>