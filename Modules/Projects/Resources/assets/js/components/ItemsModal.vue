<template>
    <div>
        <modal :show="show" @close="close">
            The elements that we wanted to be shown or used.
        </modal>
    </div>
</template>

<script>
import Modal from './Modal.vue'
export default {
    props: ['show'],
    components: { Modal },
    methods: {
        close: function() {
            this.$emit('close')
        }
    }
}
</script>
