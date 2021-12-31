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
                        <h5 class="modal-title">Update Guest</h5>
                        <button type="button" class="close" @click="CloseModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateGuest">
                            <div class="form-group">
                                <label>Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="name"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="email"
                                />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="phone"
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
    props: ["id", "guest"],
    data() {
        return {
            isOpenModal: false,
            name: JSON.parse(this.guest).name,
            email: JSON.parse(this.guest).email,
            phone: JSON.parse(this.guest).phone,
        };
    },
    methods: {
        OpenModal() {
            this.isOpenModal = true;
        },
        CloseModal() {
            this.isOpenModal = false;
        },
        async updateGuest() {
            try {
                await axios.patch("/updateguest/" + this.id, {
                    email: this.email,
                    phone: this.phone,
                    name: this.name,
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
