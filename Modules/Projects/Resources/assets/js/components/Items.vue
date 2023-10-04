<template>
    <div>
        <div v-for="user in users" :key="user.id">
            <items-modal
                :show="showModal(user.id)"
                @close="toggleModal(user.id)" />

            <a class="text-sm" href="#" @click.stop="toggleModal(user.id)">Show</a>
        </div>
    </div>
</template>

<script>
import ItemsModal from './ItemsModal.vue'
export default {
    components: { ItemsModal },
    data() {
        return {
            activeModal: 0,
        }
    },
    methods: {
        showModal: function(id) {
            return this.activeModal === id
        },
        toggleModal: function (id) {
            if(this.activeModal !== 0) {
                this.activeModal = 0
                return false
            }
            this.activeModal = id
        }
    }
}
</script>
