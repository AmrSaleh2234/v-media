<template >
    <div class="project-info-reciept" v-show="title == selectedTitle">
        <h2>{{title}}</h2>
        <slot ></slot>
    </div>
</template>

<script>
    import  {inject } from 'vue';
    export default {
        props : ['title'],
        setup(){
            const selectedTitle = inject("selectedTitle");
            return {
                selectedTitle
            }
        }
    }
</script>
