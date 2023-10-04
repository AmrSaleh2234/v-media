<template>
    <div class="chat-section" id="chatSection">
        <h3><a :href="'/admin/projects/'+projectId+'/chat'">{{ $t('names.tasks-chat') }}</a></h3>
        <div class="messages-container" ref="chatContainer">
            <div class="message-row" v-for="message in messages" :key="message.id">
                <div class="message-card">
                    <div class="head">
                        <div class="person-info">
                            <img
                                :src=" message.from.avatar  ?? 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50' "
                                alt="profile pic"
                                class="user-image-chat"
                            />
                            <h3 class="name">{{ message.from.name }}</h3>
                        </div>
                        <div class="message-privacy">
                            <div class="message" :privacy="message.public ? 'public' : 'private'"></div>
                        </div>
                    </div>
                    <p class="content">
                        {{ message.content }}
                    </p>
                </div>
                <div  v-for="file in message.attachments" :key="file.id">
                    <small class="badge bg-white text-primary "> {{ file.size }}</small>
                    <a :href="'/storage/' + file.path" :download="file.original_name" > <i class='bx bxs-download bx-sm' ></i></a>
                </div>
                <div class="message-buttons">
                    <i class="icon-category"></i>
                    <i class="icon-chart"></i>
                </div>
            </div>
        </div>
        <form class="send-message-form" @submit.prevent="sendMessage" enctype="multipart/form-data">
            <input type="text" v-model="newMessage" :placeholder="$t('write-your-message')" name="message">
            <!--            <input type="checkbox" class="checkbox" v-model="public" >-->
            <input type="file" @change="addFiles" multiple ref="files" name="files">
            <!--            <i class='bx bx-paperclip bx-rotate-270 bx-sm'  @click="addFile"></i>-->
            <i class="bx bx-send bx-rotate-180 bx-sm" @click="sendMessage"></i>

        </form>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    props: {
        projectId: {
            required: true
        },
        url: {
            type: String,
            required: false
        },
        trans: {
            type: Array,
            required: false
        }
    },
    data() {
        return {
            messages: [],
            newMessage: '',
            files: [],
            public: true,
            chatContainer: null,
        }
    },
    methods: {
        getMessages() {
            axios.post('/admin/chat', {projectId: this.projectId}).then(response => {
                this.messages = response.data;
                this.$forceUpdate();
                this.$nextTick(() => {
                    this.chatContainer.scrollTop = this.chatContainer?.scrollHeight;
                });
            });
        },
        sendMessage() {
            if (this.newMessage === '' && this.files.length === 0) {
                return;
            }
            axios.post('/admin/chat/send', {
                    projectId: this.projectId,
                    content: this.newMessage,
                    files: this.files,
                    public: this.public
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response => {
                this.messages.push(response.data);
                this.newMessage = "";
                this.files.value = null;
                this.$refs.files.value = null;
                this.$nextTick(() => {
                    this.chatContainer.scrollTop = this.chatContainer?.scrollHeight;
                });
                // this.$forceUpdate();
                // this.getMessages();
            });

        },
        addFiles(e) {
            this.files = e.target.files;
        },
        removeFile() {
            this.files = null;
        },
        download(path) {
            axios.post('/download', {path: path}).then(response => {
            });

        }
    },
    mounted() {
        this.chatContainer = this.$refs.chatContainer;
        this.getMessages();
        setInterval(this.getMessages, 5000);
    }
}
</script>
