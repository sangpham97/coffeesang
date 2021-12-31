<template>
    <div>
        <a class="text-primary" style="cursor: pointer" @click="OpenModal"
            >update</a
        >
        <!-- modal -->
        <div :class="ModalClassToggle">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" @click="CloseModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateUser">
                            <div class="form-group">
                                <label>Email address</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="email"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="username"
                                />
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="CloseModal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id", "user"],
    data() {
        return {
            isOpenModal: false,
            username: JSON.parse(this.user).name,
            email: JSON.parse(this.user).email,
        };
    },
    methods: {
        OpenModal() {
            this.isOpenModal = true;
        },
        CloseModal() {
            this.isOpenModal = false;
        },
        async updateUser() {
            try {
                await axios.patch("/updateuser/" + this.id, {
                    name: this.username,
                    email: this.email,
                });
            } catch (err) {
                console.log(err);
            }
            location.reload();
        },
    },
    computed: {
        ModalClassToggle() {
            if (this.isOpenModal) {
                return "";
            } else {
                return "modal";
            }
        },
    },
};
</script>
