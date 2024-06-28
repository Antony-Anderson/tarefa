<template>
    <div>
        <div class="d-flex align-items-center mb-4 justify-content-end">
            <button @click="$eventBus.emit('mudar-senha')" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                Alterar senha
            </button>
        </div>
        <perfil-show></perfil-show>
        <alterar-senha></alterar-senha>
    </div>
</template>