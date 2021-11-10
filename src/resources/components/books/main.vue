<template>
  <section>
    <b-loading v-model="isLoading"></b-loading>
    <div class="block">
      <h2 class="title is-3 is-inline">Catálogo de libros</h2>
      <b-button
        @click="showNewModal = !showNewModal"
        type="is-success is-pulled-right"
        icon-left="plus"
        >
        Nuevo
      </b-button
      >
    </div>
    <div class="block pt-5">
      <b-table
        :data="data"
        :paginated="true"
        :mobile-cards="true"
      >
        <b-table-column field="title" label="Título" v-slot="props">
          {{ props.row.title }}
        </b-table-column>

        <template #empty>
          <div class="has-text-centered">No hay datos</div>
        </template>
      </b-table>
    </div>
    <create-books-modal 
      v-if="showNewModal" 
      @close="showNewModal = !showNewModal"
      @created="addNewItem($event)"
      @loading="isLoading = $event.value">
    </create-books-modal>
  </section>
</template>

<script>
module.exports = {
  data: function () {
    return {
      isLoading: false,
      data: [],
      showNewModal: false,
    };
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.isLoading = true;
      axios
        .get("/api/books")
        .then((response) => {
          this.data = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.isLoading = false));
    },
    addNewItem(newItem) {
      console.log(newItem)
      this.data.push(newItem)
      this.showNewModal = false
    }
  },
};
</script>