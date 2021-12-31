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
                        <h5 class="modal-title">Update Product</h5>
                        <button type="button" class="close" @click="CloseModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateProduct">
                            <div class="form-group">
                                <label>Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="title"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="price"
                                />
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

                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    >SalePrice</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="saleprice"
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
    props: ["id", "product"],
    data() {
        return {
            isOpenModal: false,
            title: JSON.parse(this.product).title,
            price: JSON.parse(this.product).price,
            saleprice: JSON.parse(this.product).saleprice,
            rating: JSON.parse(this.product).rating,
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
                await axios.patch("/updateproduct/" + this.id, {
                    title: this.title,
                    price: this.price,
                    saleprice: this.saleprice,
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
