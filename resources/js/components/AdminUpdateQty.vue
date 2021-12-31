<template>
    <div>
        <a class="text-primary ml-1" style="cursor: pointer" @click="OpenModal"
            >update</a
        >
        <!-- modal -->
        <div :class="ModalClassToggle">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Quantity</h5>
                        <button type="button" class="close" @click="CloseModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateQuantity">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="quantity"
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
    props: ["id", "qty", "total", "price"],
    data() {
        return {
            isOpenModal: false,
            quantity: 1,
            NewTotal: JSON.parse(this.total),
        };
    },
    methods: {
        OpenModal() {
            this.isOpenModal = true;
        },
        CloseModal() {
            this.isOpenModal = false;
        },
        async updateQuantity() {
            try {
                if (this.quantity > this.qty) {
                    this.NewTotal += (this.quantity - this.qty) * this.price;

                    await axios.patch("/updateqty/" + this.id, {
                        quantity: this.quantity,
                        total: this.NewTotal,
                    });
                } else if (this.quantity < this.qty) {
                    this.NewTotal -= (this.qty - this.quantity) * this.price;

                    await axios.patch("/updateqty/" + this.id, {
                        quantity: this.quantity,
                        total: this.NewTotal,
                    });
                } else {
                    await axios.patch("/updateqty/" + this.id, {
                        quantity: this.quantity,
                        total: this.total,
                    });
                }
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
