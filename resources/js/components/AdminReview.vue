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
                        <h5 class="modal-title">Update Review</h5>
                        <button type="button" class="close" @click="CloseModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateProduct">
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea
                                    cols="30"
                                    rows="10"
                                    v-model="comment"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rating</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="rating"
                                    max="5"
                                    min="1"
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
    props: ["id", "review"],
    data() {
        return {
            isOpenModal: false,
            comment: JSON.parse(this.review).comment,
            rating: JSON.parse(this.review).rating,
        };
    },
    methods: {
        OpenModal() {
            this.isOpenModal = true;
        },
        CloseModal() {
            this.isOpenModal = false;
        },
        async updateProduct() {
            try {
                await axios.patch("/updatereview/" + this.id, {
                    comment: this.comment,
                    rating: this.rating,
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
