<template>
    <div>
         <button @click="$eventBus.emit('criar-tarefa')" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4 mt-4">
            Nova
        </button>

        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-list-check"></i>
                    Tarefas
                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <tarefa-table></tarefa-table>
            </div>
        </div>

        <tarefa-create></tarefa-create>
        <tarefa-update></tarefa-update>
        <tarefa-destroy></tarefa-destroy>
    </div>
</template>

<script>
    export default{
        
    }
</script>
