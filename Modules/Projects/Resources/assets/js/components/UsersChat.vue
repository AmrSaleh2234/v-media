<template>
    <section class="projects-chat-page">

    <div class="chat-users-container">
        <div class="search-bar">
            <input type="text" placeholder="ادخل اسم المستخدم" v-model="query" />
            <div class="search-icon">Search</div>
        </div>
        <div class="cards-container">
            <div class="chat-card" @click="selectedId = 0">
                <div class="right">
                    <img :src=" project.avatar ?? projectImg" alt=""/>
                </div>
                <div class="left" >
                    <div class="head">
                        <h4>{{ project.name }}</h4>
                        <div class="time-and-active" v-if="project.last_message" :active="project.last_message[0]?.seen?.length ? '' : 'active' ">
                            <h4 >{{ project.last_message[0]?.created_at }}</h4>
                        </div>
                    </div>
                    <p class="message-content" v-if="project.last_message">
                        {{ project.last_message[0]?.content }}
                    </p>
                </div>
            </div>

            <div class="chat-card" v-for="user in listUsers " :key="user.id" @click="selectedId = user.id ; this.$forceUpdate(); ">
                <div class="right">
                    <img
                        :src=" user.image ?? user.avatar "
                        :alt=" user.name "
                    />
                </div>
                <div class="left" >
                    <div class="head">
                        <h4>{{ user.name }}</h4>
                        <div class="time-and-active" v-if="user.last_message"  :active="user.last_message?.seen?.length ? '' : 'active' ">
                            <h4 >{{ user.last_message.created_at }}</h4>
                        </div>
                    </div>
                    <p class="message-content" v-if="user.last_message">
                        {{ user.last_message.content }}
                    </p>
                </div>
            </div>
        </div>
    </div>
        <project-chat v-if="selectedId === 0" :project-id="projectId" @refresh-parent="getUsers" ></project-chat>
        <chat v-else :project-id="projectId" :user-id="selectedId" :key="selectedId" @refresh-parent="getUsers" ></chat>
    </section>

</template>

<script >
import axios from 'axios';
import chat from "./Chat.vue";
import ProjectChat from "./ProjectChat.vue";
export default {
    components :{
        chat,
        ProjectChat
    },
    props: {
        projectId: {
            type: Number,
            required: true
        },
        trans:{
            type: Array,
            required: false
        }
    },
    data() {
        return {
            users : [],
            project : [],
            query: '',
            selectedId : 0,
            user : [] ,
            projectImg : '/assets/images/group.png' ,
            userImg : '/assets/images/profile-image.png'  ,

        }
    },
    watch: {
        query() {
            this.search();
        },
        userId() {
            this.$refs.child.updateData();
        }
    },
    computed: {
        listUsers() {
            if (!this.query) {
                return this.users;
            }
            const lowerCaseQuery = this.query.toLowerCase();
            return this.users.filter(user => user.name.toLowerCase().includes(lowerCaseQuery));
        }
    },
    methods: {
        getUsers() {
            axios.post('/admin/chat/users' , {projectId: this.projectId}).then(response => {
                this.users = response.data.users;
                this.project = response.data.project;
            });
        },
        search(){
            this.users.filter(user => {
                return user.name.toLowerCase().includes(this.query.toLowerCase());
            });
        },
        selectUser(id){
            this.user = this.users.filter(user => {
                return user.id.includes(id);
            });
        }
        // searchUsers() {
        //     if(this.query === ''){
        //         return ;
        //     }
        //     axios.post('/admin/chat/search', { query: this.query , projectId: this.projectId}).then(response => {
        //         console.log(response.data);
        //         this.listUsers.push(response.data);
        //         this.query = "";
        //         // this.$forceUpdate();
        //     });
        // }
    },
    mounted() {
        this.getUsers();
    }
}
</script>
