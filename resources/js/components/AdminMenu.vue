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
                        <h5 class="modal-title">Update Menu</h5>
                        <button type="button" class="close" @click="CloseModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateMenu">
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
import axiosInstance from "../axiosInstance";
export default {
    props: ["id", "menu"],
    data() {
        return {
            isOpenModal: false,
            title: JSON.parse(this.menu).title,
            price: JSON.parse(this.menu).price,
            saleprice: JSON.parse(this.menu).saleprice,
        };
    },
    methods: {
        OpenModal() {
            this.isOpenModal = true;
        },
        CloseModal() {
            this.isOpenModal = false;
        },
        async updateMenu() {
            try {
                await axios.patch("/updatemenu/" + this.id, {
                    title: this.title,
                    price: this.price,
                    saleprice: this.saleprice,
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
