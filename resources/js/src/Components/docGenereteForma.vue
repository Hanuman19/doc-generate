<template>
    <div>
        <div class="input-group mb-3">
            <input
                v-model="forma.name"
                type="text"
                class="form-control"
                placeholder="Наименование поставщика"
                aria-label="Наименование поставщика"
                aria-describedby="basic-addon2"
            >
        </div>
        <div class="input-group mb-3">
            <input
                v-model="forma.inn"
                type="text"
                class="form-control"
                placeholder="ИНН постовщика"
                aria-label="ИНН постовщика"
                aria-describedby="basic-addon2"
                @input="validateNumber(forma.inn)"
            >
        </div>
        <div class="input-group mb-3">
            <input
                v-model="forma.kpp"
                type="text"
                class="form-control"
                placeholder="КПП постовщика"
                aria-label="КПП постовщика"
                aria-describedby="basic-addon2"
            >
        </div>
        <div class="input-group mb-3">
            <input
                ref="upload"
                type="file"
                :file="logo"
                accept=".jpg,.png"
                class="form-control"
                @change="inputFile($event)"
            >
        </div>
        <div class="input-group mb-3">
            <input
                v-model="forma.shopper.fio"
                type="text"
                class="form-control"
                placeholder="ФИО покупателя"
                aria-label="ФИО покупателя"
                aria-describedby="basic-addon2"
            >
        </div>
        <div class="input-group mb-3">
            <input
                v-model="forma.shopper.inn"
                type="text"
                class="form-control"
                placeholder="ИНН покупателя"
                aria-label="ИНН покупателя"
                aria-describedby="basic-addon2"
            >
        </div>
        <template v-for="(product, index) in forma.products" :key="index">
            <Products
                :product="product"
                :dell="forma.products.length > 1"
                @dell-product="dellProduct(index)"
            />
        </template>
        <template v-if="error">
            <div>
                Все поля должны быть запленены
            </div>
        </template>
        <button type="button" class="btn btn-primary" @click="save">Сформировать</button>
        <button type="button" class="btn btn-success" @click="addProduct">Добавить товар</button>
    </div>
</template>

<script>
import _ from 'lodash'
import Products from "./Products.vue";
export default {
    name: "docGenereteForma",
    components: {
        Products
    },
    data() {
        return {
            error: false,
            logo: {},
            forma: {
                name: null,
                inn: null,
                kpp: null,
                shopper: {
                    fio: null,
                    inn: null
                },
                products: [
                    {
                        name: null,
                        quantity: null,
                        price: null,
                    },
                ],
                logo_path:null
            }
        };
    },
    watch: {
        'forma.inn'() {
            this.forma.inn = this.forma.inn.replace(/[^0-9]/g,'');
        },
        'forma.kpp'() {
            this.forma.kpp = this.forma.kpp.replace(/[^0-9]/g,'');
        },
        'forma.shopper.inn'() {
            this.forma.shopper.inn = this.forma.shopper.inn.replace(/[^0-9]/g,'');
        }
    },
    methods: {
        validateNumber(value) {

        },
        dellProduct(index) {
            this.forma.products.splice(index, 1);
        },
        save() {
            this.error = false;
            axios.post(`/api/docs/`, this.forma, {responseType: 'arraybuffer'})
                .then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'file.pdf');
                    document.body.appendChild(link);
                    link.click();
                })
                .catch((error) => {
                    if (error.code === "ERR_BAD_REQUEST") {
                        this.error = true;
                    }
                });
        },
        addProduct() {
            this.forma.products.push({
                id: this.forma.products.length + 1,
                name: null,
                quantity: null,
                price: null,
            });
        },
        inputFile($event) {
            let el = ($event.srcElement || $event.target);

            this.addFiles(el.files);

        },
        addFiles(files) {
            if (files && files.length > 0) {
                _.each(files, (value) => {
                    this.logo = value;
                });
            }
            this.uploadFile();
        },
        uploadFile() {
            let form = new FormData();
            form.append('logo', this.logo);
            axios.post(`/api/upload_logo/`, form, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.forma.logo_path = response.data
                })
                .catch((error) => {
                    console.log(error.data.message)
                });
        }
    }
}
</script>

<style scoped>

</style>
