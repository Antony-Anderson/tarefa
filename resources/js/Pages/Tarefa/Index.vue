<template>
    <div>
         <button @click="$eventBus.emit('criar-tarefa')" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4 mt-4">
            Nova
        </button>
        <tarefa-table></tarefa-table>
        <tarefa-create></tarefa-create>
        <tarefa-update></tarefa-update>
        <tarefa-destroy></tarefa-destroy>
    </div>
</template>

<script>
    export default{
        
    }
</script>
