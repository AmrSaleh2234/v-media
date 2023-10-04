<template>
    <h1>{{ greeting }}</h1>
    <button class="btn btn-primary" @click="count++;this.$forceUpdate();">{{count}}</button>
</template>
<script>
export default {
    setup: () => ({
    greeting: 'Vue 3 Is Working inside livewire !',
        count: 0
    })
}
</script>
