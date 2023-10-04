<template>
<!--    <div class="" v-if="loading"></div>-->
    <div  class="user-chat-container">
        <div class="head mb-2 px-4">
            <div class="user-info">
                <h4>{{ project.name }}</h4>
            </div>
            <div class="settings-icon">
                <i class="icon-trash"></i>
            </div>
        </div>
        <div class="messages-container loading "  v-if="loading"></div>
        <div
            class="messages-container "
            id="chat-cards-container"
            ref="chatContainer"
            v-else
        >
            <div
                class="message-container"
                :by="message.from.id == this.userId ? 'user' : 'other'"
                v-if="messages"
                v-for="message in messages"
                :key="message.id"
            >
                <div class="message-card">
                    <div class="head">
                        <div class="user-info">
                            <div class="user-profile-image">
                                <img
                                    :src="
                                        message.from.avatar ??
                                        userImg
                                    "
                                    alt=""
                                />
                            </div>
                            <h4>{{ message.from.name }}</h4>
                            <div class="settings-icon"></div>
                        </div>
                    </div>
                    <div class="content">
                        {{ message.content }}
                    </div>
                    <div class="time">{{ message.created_at }}</div>
                    <div  v-for="file in message.attachments" :key="file.id">
                        <small class="badge bg-white text-primary "> {{ file.size }}</small>
                        <a :href="'/storage/' + file.path" :download="file.original_name" > <i class='bx bxs-download bx-sm' ></i></a>
                    </div>
                </div>
            </div>
            <div class="message-container" v-else>
                <h3>Send your First Message</h3>
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
        trans: {
            type: Array,
            required: false,
        },
    },
    data() {
        return {
            project: [],
            messages: [],
            newMessage: "",
            files: null,
            userId: 0,
            projectImg: "/assets/images/group.png",
            userImg: "/assets/images/profile-image.png",
            chatContainer: null,
            loading : false
        };
    },
    methods: {
        getMessages() {
            return axios
                .post("/admin/chat/project", { projectId: this.projectId })
                .then((response) => {
                    this.messages = response.data.messages;
                    this.userId = response.data.userId;
                    this.project = response.data.project;
                    this.loading = false;
                    this.chatContainer = this.$refs.chatContainer;
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
                    files: this.files,
                    content: this.newMessage,
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
                    this.$emit("refresh-parent");
                    this.getMessages();

                });
        },
        addFiles(e) {
            this.files = e.target.files;
        },
    },
    mounted() {
        this.getMessages();
        setInterval(this.getMessages, 5000);
    },
};
</script>
