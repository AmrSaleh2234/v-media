<template>
    <div class="user-chat-container">
        <div class="head">
            <div class="user-info">
                <div class="user-profile-image">
                    <img :src="user.image ?? user.avatar" :alt="user.name" />
                </div>
                <h4>{{ user.name }}</h4>
            </div>
            <div class="settings-icon">
                <i class="icon-trash"></i>
            </div>
        </div>
        <div
            class="messages-container"
            id="chat-cards-container"
            ref="chatContainer"
        >
            <div
                class="message-container"
                :by="userId !== message.from_id ? 'user' : 'other'"
                v-for="message in messages"
                v-if="messages.length > 0"
            >
                <div class="message-card">
                    <div class="content">
                        {{ message.content }}
                    </div>

                    <div class="time">
                        <span>
                            {{ message.created_at }}
                        </span>
                        <span v-if="message.seen?.length">✓✓</span>
                        <span v-else>✓</span>
                    </div>
                    <div  v-for="file in message.attachments" :key="file.id">
                        <small class="badge bg-white text-primary "> {{ file.size }}</small>
                        <a :href="'/storage/' + file.path" :download="file.original_name" > <i class='bx bxs-download bx-sm' ></i></a>
                    </div>
                </div>
            </div>
            <div class="message-container" v-else>
                <h3 class="text-center">Send your First Message</h3>
            </div>
        </div>
        <form class="send-message-container" @submit.prevent="sendMessage" enctype="multipart/form-data">
            <input type="text" v-model="newMessage" :placeholder="$t('write-your-message')" name="message">
            <!--            <input type="checkbox" class="checkbox" v-model="public" >-->
            <input type="file" @change="addFiles" multiple ref="files" name="files">
            <!--            <i class='bx bx-paperclip bx-rotate-270 bx-sm'  @click="addFile"></i>-->
            <div class="controls">
                <i class="bx bx-send bx-rotate-180 bx-sm" @click="sendMessage"></i>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        projectId: {
            type: Number,
            required: true,
        },
        userId: {
            type: Number,
            required: false,
        },
        trans: {
            type: Array,
            required: false,
        },
    },
    data() {
        return {
            messages: [],
            user: [],
            newMessage: "",
            files:null,
            public: false,
            userImg: "/assets/images/profile-image.png",
            chatContainer: null,
        };
    },
    methods: {
        getMessages() {
            return axios
                .post("/admin/chat/user", {
                    projectId: this.projectId,
                    userId: this.userId,
                })
                .then((response) => {
                    this.messages = response.data.messages;
                    this.user = response.data.user;
                    this.$nextTick(() => {
                        this.chatContainer.scrollTop =
                            this.chatContainer.scrollHeight;
                        this.$emit("refresh-parent");
                    });
                });
        },
        sendMessage() {
            if (this.newMessage === "") {
                return;
            }
            axios
                .post("/admin/chat/send", {
                    projectId: this.projectId,
                    content: this.newMessage,
                    files: this.files,
                    userId: this.userId,
                },{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    this.messages.push(response.data);
                    this.newMessage = "";
                    this.files.value = null;
                    this.$refs.files.value = null;
                    // this.$forceUpdate();
                    // this.getMessages();
                    this.$emit("refresh-parent");
                    this.$nextTick(() => {
                        this.chatContainer.scrollTop =
                            this.chatContainer.scrollHeight;
                    });
                });
        },
        addFiles(e){
            this.files = e.target.files;
        }
    },
    mounted() {
        this.chatContainer = this.$refs.chatContainer;
        this.getMessages();
        setInterval(this.getMessages, 5000);
    },
};
</script>
