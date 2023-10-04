<template>
    <div class="page-content">
        <div class="section-navbar">
            <div v-for="title in tabsTitles" class="item" :class="{ 'active': selectedTitle == title }"  :key="title" @click="selectedTitle = title">
                {{ title }}
            </div>
        </div>
            <slot ></slot>
    </div>

</template>

<script>

 import { ref ,provide } from 'vue';

 export default {
     name: 'ProjectTabs',
     setup(props , {slots}) {
         const tabsTitles = ref(slots.default().map((tab)=> tab.props.title));
         const selectedTitle = ref(tabsTitles.value[0]);
         provide("selectedTitle",selectedTitle);

         return {
             tabsTitles,
             selectedTitle
         };
     }
 };
</script>
