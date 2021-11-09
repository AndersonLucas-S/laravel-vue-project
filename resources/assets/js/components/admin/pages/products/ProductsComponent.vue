<template>
    <div>
        <h1>Listagem de produtos</h1>

        <div class="row">
            <div class="col">
                <button class="btn btn-success" @click.prevent="showModal = true">Novo</button>
                <vodal :show="showModal" animation="zoom" @hide="hideModal" :width="700" :height="600"> 
                    <product-form @success="success"></product-form>
                </vodal>
            </div>
        </div>
        <br/>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Marca</th>
                    <th>Quantidade</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products.data" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.brand }}</td>
                    <td>{{ product.amount }}</td>
                    <td>
                        <a href="#" class="btn btn-info">Editar</a>
                        <a href="#" class="btn btn-danger">Deletar</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <ul v-if="products.last_page > 1">
            <li v-if="products.current_page > 1">
                <a href="#" @click.prevent="loadProducts(products.current_page - 1)"> Anterior</a>
            </li>
            <li v-if="products.current_page < products.last_page">
                <a href="#" @click.prevent="loadProducts(products.current_page + 1)"> Próxima</a>
            </li>
        </ul>
    </div>
</template>

<script>
import Vodal from 'vodal';
import ProductForm from './partials/ProductForm';

export default {
    created () {
        this.loadProducts(1)
    },
    data () {
        return {
            showModal: false,
        }
    },
    computed: {
        products (){
            return this.$store.state.products.items
        },
        params () {
            page: this.products.current_page
        }
    },
    methods: {
        loadProducts (page) {
            this.$store.dispatch('loadProducts', {...this.params, page})
        },
        hideModal (){
            this.showModal = false;
        },
        success (){
            this.hideModal()

            this.loadProducts(1)
        }
    },
    components: {
        Vodal,
        ProductForm,
    }
}
</script>
 
<style scoped>
 
 </style>