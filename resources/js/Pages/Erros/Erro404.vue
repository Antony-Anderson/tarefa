<template>
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Página não encontrada</p>
        <p class="text-gray-500 mb-0">Parece que você encontrou uma falha na matriz...</p>
        <router-link :to="{name: 'Tarefa'}">
            &larr; Volte para o Home
        </router-link>
    </div>
</template>