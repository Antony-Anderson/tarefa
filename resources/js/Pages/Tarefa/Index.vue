<template>
    <div>
        <div class="card shadow mb-4 mt-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-list-check"></i>
                    Tarefas
                </h6>
                <div class="ms-auto d-flex">
                    <button @click="$eventBus.emit('criar-tarefa')" class="btn btn-primary justify-content-between me-2">
                        Nova
                    </button>
                    <button @click="$eventBus.emit('selecionar-tarefas')" class="btn btn-success">Excluir todas as tarefas concluidas</button>
                </div>
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
