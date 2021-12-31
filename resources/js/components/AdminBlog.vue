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
                        <h5 class="modal-title">Update Blog</h5>
                        <button type="button" class="close" @click="CloseModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateBlog">
                            <div class="form-group">
                                <label>Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="title"
                                />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea
                                    cols="30"
                                    rows="10"
                                    v-model="desc"
                                ></textarea>
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
    props: ["id", "blog"],
    data() {
        return {
            isOpenModal: false,
            title: JSON.parse(this.blog).title,
            desc: JSON.parse(this.blog).desc,
        };
    },
    methods: {
        OpenModal() {
            this.isOpenModal = true;
        },
        CloseModal() {
            this.isOpenModal = false;
        },
        async updateBlog() {
            try {
                await axios.patch("/updateblog/" + this.id, {
                    title: this.title,
                    desc: this.desc,
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
