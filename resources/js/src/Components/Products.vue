<template>
    <div>
        <div class="input-group mb-3">
            <input
                v-model="product.name"
                type="text"
                class="form-control"
                placeholder="Нименование продукта"
                aria-label="Нименование продукта"
                aria-describedby="basic-addon2"
            >
            <input
                v-model="product.quantity"
                type="text"
                class="form-control"
                placeholder="Количество"
                aria-label="Количество"
                aria-describedby="basic-addon2"
            >
            <input
                v-model="product.price"
                type="text"
                class="form-control"
                placeholder="Цена"
                aria-label="Цена"
                aria-describedby="basic-addon2"
            >
            <button
                v-if="dell"
                type="button"
                class="btn btn-danger"
                @click="$emit('dell-product')"
            >
                Удалить товар
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Products",
    props: {
        product: {
            types: Object,
            default: () => {
                return {}
            }
        },
        dell: {
            types: Boolean,
            default: () => {
                return false
            }
        }
    },
    watch: {
        'product.quantity'() {
            this.product.quantity = this.product.quantity.replace(/[^0-9]/g,'');
        },
        'product.price'() {
            this.product.price = this.product.price.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1');;
        },
    },
}
</script>

<style scoped>

</style>
