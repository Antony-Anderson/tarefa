<template>
    <div>
        <div class="modal fade" ref="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <slot name="modalHeader"></slot>
                        <button @click="close()" type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="modalFooter"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                modal:null
            }
        },
        mounted(){
            this.modal = new bootstrap.Modal(this.$refs.modal);
        },
        methods:{
            open(){
                this.modal.show();
            }, 
            close(){
                this.modal.hide();
            }
        }
    }
</script>