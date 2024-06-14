<template>
    <div>
         <button @click="$eventBus.emit('criar-tarefa')" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            Nova
        </button>
        <tarefa-table></tarefa-table>
        <tarefa-create></tarefa-create>
    </div>
</template>

<script>
    export default{
        
    }
</script>
